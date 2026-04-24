<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Models\Statistic;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    protected static string | \UnitEnum | null $navigationGroup = 'Marketing';

    protected static ?string $navigationLabel = 'Thống kê';

    protected static ?string $modelLabel = 'Thống kê';

    protected static ?string $pluralModelLabel = 'Thống kê';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin thống kê')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('label')
                            ->label('Nhãn')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        TextInput::make('value')
                            ->label('Giá trị')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('unit')
                            ->label('Đơn vị')
                            ->maxLength(50),

                        TextInput::make('icon')
                            ->label('Icon (CSS class)')
                            ->maxLength(100),

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
                TextColumn::make('label')
                    ->label('Nhãn')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('value')
                    ->label('Giá trị'),

                TextColumn::make('unit')
                    ->label('Đơn vị'),

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
            'index'  => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit'   => Pages\EditStatistic::route('/{record}/edit'),
        ];
    }
}
