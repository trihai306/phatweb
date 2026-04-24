<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | \UnitEnum | null $navigationGroup = 'Nội dung';

    protected static ?string $navigationLabel = 'Trang nội dung';

    protected static ?string $modelLabel = 'Trang';

    protected static ?string $pluralModelLabel = 'Trang nội dung';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin cơ bản')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->columnSpan(2),

                        TextInput::make('slug')
                            ->label('Đường dẫn (Slug)')
                            ->required()
                            ->maxLength(255)
                            ->disabledOn('edit')
                            ->unique(Page::class, 'slug', ignoreRecord: true),

                        Select::make('section')
                            ->label('Phân khu')
                            ->options([
                                'aboutus'  => 'Về chúng tôi',
                                'services' => 'Dịch vụ',
                                'whyus'    => 'Tại sao chọn chúng tôi',
                            ]),

                        Select::make('parent_id')
                            ->label('Trang cha')
                            ->relationship('parent', 'title')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Textarea::make('excerpt')
                            ->label('Mô tả ngắn')
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                ]),

            Section::make('Nội dung')
                ->schema([
                    RichEditor::make('content')
                        ->label('Nội dung')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('pages/attachments')
                        ->columnSpanFull(),
                ]),

            Section::make('Hình ảnh đại diện')
                ->schema([
                    FileUpload::make('featured_image')
                        ->label('Hình ảnh đại diện')
                        ->image()
                        ->directory('pages')
                        ->imageEditor()
                        ->columnSpanFull(),
                ]),

            Section::make('Cài đặt')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('sort_order')
                            ->label('Thứ tự sắp xếp')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->default(true),
                    ]),
                ]),

            Section::make('SEO')
                ->collapsed()
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('meta_title')
                            ->label('Tiêu đề SEO')
                            ->maxLength(255)
                            ->columnSpan(2),

                        Textarea::make('meta_description')
                            ->label('Mô tả SEO')
                            ->rows(3)
                            ->columnSpan(2),

                        TextInput::make('meta_keywords')
                            ->label('Từ khóa SEO')
                            ->maxLength(500)
                            ->columnSpan(2),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('section')
                    ->label('Phân khu')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'aboutus'  => 'Về chúng tôi',
                        'services' => 'Dịch vụ',
                        'whyus'    => 'Tại sao chọn chúng tôi',
                        default    => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'aboutus'  => 'info',
                        'services' => 'success',
                        'whyus'    => 'warning',
                        default    => 'gray',
                    }),

                ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),

                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([])
            ->actions([
                EditAction::make()->label('Sửa'),
                DeleteAction::make()->label('Xóa'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Xóa đã chọn'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
