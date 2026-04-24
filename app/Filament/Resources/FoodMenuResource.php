<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodMenuResource\Pages;
use App\Models\FoodMenu;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FoodMenuResource extends Resource
{
    protected static ?string $model = FoodMenu::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cake';

    protected static string | \UnitEnum | null $navigationGroup = 'Dịch vụ';

    protected static ?string $navigationLabel = 'Thực đơn';

    protected static ?string $modelLabel = 'Thực đơn';

    protected static ?string $pluralModelLabel = 'Thực đơn';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin cơ bản')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Tên món')
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
                            ->unique(FoodMenu::class, 'slug', ignoreRecord: true),

                        Select::make('category')
                            ->label('Danh mục')
                            ->options([
                                'appetizer'   => 'Khai vị',
                                'main'        => 'Món chính',
                                'dessert'     => 'Tráng miệng',
                                'drink'       => 'Đồ uống',
                                'combo'       => 'Combo',
                                'special'     => 'Món đặc biệt',
                            ])
                            ->searchable(),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                ]),

            Section::make('Hình ảnh')
                ->schema([
                    FileUpload::make('image')
                        ->label('Hình ảnh')
                        ->image()
                        ->directory('menus')
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
                    ->label('Tên món')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Danh mục')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'appetizer' => 'Khai vị',
                        'main'      => 'Món chính',
                        'dessert'   => 'Tráng miệng',
                        'drink'     => 'Đồ uống',
                        'combo'     => 'Combo',
                        'special'   => 'Món đặc biệt',
                        default     => $state,
                    }),

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
            'index'  => Pages\ListFoodMenus::route('/'),
            'create' => Pages\CreateFoodMenu::route('/create'),
            'edit'   => Pages\EditFoodMenu::route('/{record}/edit'),
        ];
    }
}
