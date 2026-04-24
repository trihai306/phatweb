<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryMilestoneResource\Pages;
use App\Models\HistoryMilestone;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HistoryMilestoneResource extends Resource
{
    protected static ?string $model = HistoryMilestone::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clock';

    protected static string | \UnitEnum | null $navigationGroup = 'Cài đặt';

    protected static ?string $navigationLabel = 'Lịch sử';

    protected static ?string $modelLabel = 'Mốc lịch sử';

    protected static ?string $pluralModelLabel = 'Lịch sử công ty';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin mốc lịch sử')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('year')
                            ->label('Năm')
                            ->required()
                            ->maxLength(10),

                        TextInput::make('sort_order')
                            ->label('Thứ tự sắp xếp')
                            ->numeric()
                            ->default(0),

                        TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(4)
                            ->columnSpan(2),
                    ]),
                ]),

            Section::make('Hình ảnh')
                ->schema([
                    FileUpload::make('image')
                        ->label('Hình ảnh')
                        ->image()
                        ->directory('history')
                        ->imageEditor()
                        ->columnSpanFull(),
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

                TextColumn::make('year')
                    ->label('Năm')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Thứ tự')
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
            'index'  => Pages\ListHistoryMilestones::route('/'),
            'create' => Pages\CreateHistoryMilestone::route('/create'),
            'edit'   => Pages\EditHistoryMilestone::route('/{record}/edit'),
        ];
    }
}
