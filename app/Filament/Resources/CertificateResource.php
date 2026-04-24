<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Models\Certificate;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap';

    protected static string | \UnitEnum | null $navigationGroup = 'Marketing';

    protected static ?string $navigationLabel = 'Chứng chỉ';

    protected static ?string $modelLabel = 'Chứng chỉ';

    protected static ?string $pluralModelLabel = 'Chứng chỉ';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin chứng chỉ')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Tên chứng chỉ')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        TextInput::make('year')
                            ->label('Năm cấp')
                            ->maxLength(10),

                        TextInput::make('sort_order')
                            ->label('Thứ tự sắp xếp')
                            ->numeric()
                            ->default(0),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->columnSpan(2),
                    ]),
                ]),

            Section::make('Hình ảnh')
                ->schema([
                    FileUpload::make('image')
                        ->label('Hình ảnh chứng chỉ')
                        ->image()
                        ->directory('certificates')
                        ->imageEditor()
                        ->columnSpanFull(),
                ]),

            Section::make('Cài đặt')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Kích hoạt')
                        ->default(true),
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
                    ->label('Tên chứng chỉ')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year')
                    ->label('Năm'),

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
            'index'  => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit'   => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
