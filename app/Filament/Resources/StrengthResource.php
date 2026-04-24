<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StrengthResource\Pages;
use App\Models\Strength;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class StrengthResource extends Resource
{
    protected static ?string $model = Strength::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-star';

    protected static string | \UnitEnum | null $navigationGroup = 'Marketing';

    protected static ?string $navigationLabel = 'Thế mạnh';

    protected static ?string $modelLabel = 'Thế mạnh';

    protected static ?string $pluralModelLabel = 'Thế mạnh';

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
                            ->unique(Strength::class, 'slug', ignoreRecord: true),

                        TextInput::make('icon')
                            ->label('Icon (CSS class)')
                            ->maxLength(100),

                        Textarea::make('description')
                            ->label('Mô tả ngắn')
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                ]),

            Section::make('Nội dung chi tiết')
                ->schema([
                    RichEditor::make('content')
                        ->label('Nội dung')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('strengths/attachments')
                        ->columnSpanFull(),
                ]),

            Section::make('Hình ảnh')
                ->schema([
                    FileUpload::make('image')
                        ->label('Hình ảnh')
                        ->image()
                        ->directory('strengths')
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
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->square()
                    ->size(60),

                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
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
            'index'  => Pages\ListStrengths::route('/'),
            'create' => Pages\CreateStrength::route('/create'),
            'edit'   => Pages\EditStrength::route('/{record}/edit'),
        ];
    }
}
