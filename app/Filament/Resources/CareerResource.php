<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
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

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static string | \UnitEnum | null $navigationGroup = 'HR';

    protected static ?string $navigationLabel = 'Tuyển dụng';

    protected static ?string $modelLabel = 'Vị trí tuyển dụng';

    protected static ?string $pluralModelLabel = 'Tuyển dụng';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Thông tin vị trí')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Tiêu đề vị trí')
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
                            ->unique(Career::class, 'slug', ignoreRecord: true),

                        TextInput::make('department')
                            ->label('Phòng ban')
                            ->maxLength(255),

                        TextInput::make('location')
                            ->label('Địa điểm')
                            ->maxLength(255),

                        TextInput::make('salary_range')
                            ->label('Mức lương')
                            ->maxLength(100),

                        DatePicker::make('deadline')
                            ->label('Hạn nộp hồ sơ')
                            ->displayFormat('d/m/Y'),

                        Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->default(true),
                    ]),
                ]),

            Section::make('Mô tả công việc')
                ->schema([
                    RichEditor::make('description')
                        ->label('Mô tả công việc')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('careers/attachments')
                        ->columnSpanFull(),
                ]),

            Section::make('Yêu cầu ứng viên')
                ->schema([
                    RichEditor::make('requirements')
                        ->label('Yêu cầu')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('careers/attachments')
                        ->columnSpanFull(),
                ]),

            Section::make('Quyền lợi')
                ->schema([
                    RichEditor::make('benefits')
                        ->label('Quyền lợi')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('careers/attachments')
                        ->columnSpanFull(),
                ]),

            Section::make('SEO')
                ->collapsed()
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('meta_title')
                            ->label('Tiêu đề SEO')
                            ->maxLength(255)
                            ->columnSpan(2),

                        TextInput::make('meta_description')
                            ->label('Mô tả SEO')
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
                    ->label('Vị trí')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('department')
                    ->label('Phòng ban')
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Địa điểm'),

                TextColumn::make('deadline')
                    ->label('Hạn nộp')
                    ->date('d/m/Y')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index'  => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit'   => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
