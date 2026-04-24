<?php

namespace App\Filament\Pages;

use App\Models\CompanyInfo;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;

class CompanyInfoPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static string|\UnitEnum|null $navigationGroup = 'Cài đặt';

    protected static ?string $navigationLabel = 'Thông tin công ty';

    protected static ?string $title = 'Thông tin công ty';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament-panels::pages.page';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $keys = [
            'company_name', 'brand_name', 'ceo_name', 'founding_year', 'tagline',
            'address', 'phone', 'email', 'website',
            'business_hours_weekday', 'business_hours_saturday', 'map_embed',
            'facebook_url', 'linkedin_url', 'youtube_url',
        ];

        $formData = [];
        foreach ($keys as $key) {
            $formData[$key] = CompanyInfo::getValue($key);
        }

        $this->form->fill($formData);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Tabs::make('Thông tin công ty')
                    ->tabs([
                        Tab::make('Thông tin chung')
                            ->schema([
                                TextInput::make('company_name')
                                    ->label('Tên công ty')
                                    ->maxLength(255),

                                TextInput::make('brand_name')
                                    ->label('Tên thương hiệu')
                                    ->maxLength(255),

                                TextInput::make('ceo_name')
                                    ->label('Tên CEO')
                                    ->maxLength(255),

                                TextInput::make('founding_year')
                                    ->label('Năm thành lập')
                                    ->maxLength(10),

                                Textarea::make('tagline')
                                    ->label('Slogan')
                                    ->rows(3),
                            ]),

                        Tab::make('Liên hệ')
                            ->schema([
                                Textarea::make('address')
                                    ->label('Địa chỉ')
                                    ->rows(3),

                                TextInput::make('phone')
                                    ->label('Số điện thoại')
                                    ->tel()
                                    ->maxLength(50),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),

                                TextInput::make('website')
                                    ->label('Website')
                                    ->url()
                                    ->maxLength(255),

                                TextInput::make('business_hours_weekday')
                                    ->label('Giờ làm việc (Thứ 2 – Thứ 6)')
                                    ->maxLength(100),

                                TextInput::make('business_hours_saturday')
                                    ->label('Giờ làm việc (Thứ 7)')
                                    ->maxLength(100),

                                Textarea::make('map_embed')
                                    ->label('Mã nhúng bản đồ')
                                    ->rows(5),
                            ]),

                        Tab::make('Mạng xã hội')
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->maxLength(500),

                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->maxLength(500),

                                TextInput::make('youtube_url')
                                    ->label('YouTube URL')
                                    ->url()
                                    ->maxLength(500),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $groupMap = [
            'company_name'              => 'general',
            'brand_name'                => 'general',
            'ceo_name'                  => 'general',
            'founding_year'             => 'general',
            'tagline'                   => 'general',
            'address'                   => 'contact',
            'phone'                     => 'contact',
            'email'                     => 'contact',
            'website'                   => 'contact',
            'business_hours_weekday'    => 'contact',
            'business_hours_saturday'   => 'contact',
            'map_embed'                 => 'contact',
            'facebook_url'              => 'social',
            'linkedin_url'              => 'social',
            'youtube_url'               => 'social',
        ];

        foreach ($data as $key => $value) {
            $group = $groupMap[$key] ?? 'general';

            CompanyInfo::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );

            Cache::forget('company_info_' . $key);
        }

        Notification::make()
            ->title('Đã lưu thông tin công ty')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Lưu thay đổi')
                ->submit('save'),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make($this->getFormActions())
                        ->alignment(\Filament\Support\Enums\Alignment::Start),
                ]),
        ]);
    }
}
