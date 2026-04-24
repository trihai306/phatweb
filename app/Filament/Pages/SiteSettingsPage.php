<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
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

class SiteSettingsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string|\UnitEnum|null $navigationGroup = 'Cài đặt';

    protected static ?string $navigationLabel = 'Cài đặt hệ thống';

    protected static ?string $title = 'Cài đặt hệ thống';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament-panels::pages.page';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $keys = [
            'seo_title', 'seo_description', 'seo_keywords', 'seo_og_image',
            'primary_color', 'primary_dark_color', 'primary_light_color', 'accent_color',
        ];

        $formData = [];
        foreach ($keys as $key) {
            $formData[$key] = Setting::get($key);
        }

        $this->form->fill($formData);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Tabs::make('Cài đặt hệ thống')
                    ->tabs([
                        Tab::make('SEO')
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('Tiêu đề SEO')
                                    ->maxLength(255),

                                Textarea::make('seo_description')
                                    ->label('Mô tả SEO')
                                    ->rows(4),

                                TextInput::make('seo_keywords')
                                    ->label('Từ khóa SEO')
                                    ->maxLength(500),

                                TextInput::make('seo_og_image')
                                    ->label('Ảnh OG mặc định')
                                    ->placeholder('/images/og-default.jpg')
                                    ->maxLength(500),
                            ]),

                        Tab::make('Giao diện')
                            ->schema([
                                ColorPicker::make('primary_color')
                                    ->label('Màu chính'),

                                ColorPicker::make('primary_dark_color')
                                    ->label('Màu chính (tối)'),

                                ColorPicker::make('primary_light_color')
                                    ->label('Màu chính (sáng)'),

                                ColorPicker::make('accent_color')
                                    ->label('Màu nhấn'),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('Đã lưu cài đặt hệ thống')
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
