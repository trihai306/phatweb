<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid as InfoGrid;
use Filament\Schemas\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';

    protected static string | \UnitEnum | null $navigationGroup = 'Liên hệ';

    protected static ?string $navigationLabel = 'Liên hệ';

    protected static ?string $modelLabel = 'Liên hệ';

    protected static ?string $pluralModelLabel = 'Liên hệ';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            InfoSection::make('Thông tin liên hệ')
                ->schema([
                    InfoGrid::make(2)->schema([
                        TextEntry::make('name')
                            ->label('Họ tên'),

                        TextEntry::make('email')
                            ->label('Email'),

                        TextEntry::make('phone')
                            ->label('Số điện thoại'),

                        TextEntry::make('subject')
                            ->label('Chủ đề'),

                        TextEntry::make('is_read')
                            ->label('Trạng thái')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Đã đọc' : 'Chưa đọc')
                            ->color(fn ($state) => $state ? 'success' : 'warning'),

                        TextEntry::make('created_at')
                            ->label('Thời gian gửi')
                            ->dateTime('d/m/Y H:i'),
                    ]),
                ]),

            InfoSection::make('Nội dung')
                ->schema([
                    TextEntry::make('message')
                        ->label('Tin nhắn')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Họ tên')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Điện thoại'),

                TextColumn::make('subject')
                    ->label('Chủ đề')
                    ->limit(40),

                ToggleColumn::make('is_read')
                    ->label('Đã đọc'),

                TextColumn::make('created_at')
                    ->label('Ngày gửi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                ViewAction::make()->label('Xem'),

                Action::make('mark_read')
                    ->label('Đánh dấu đã đọc')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Contact $record) => $record->update(['is_read' => true]))
                    ->visible(fn (Contact $record) => ! $record->is_read),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'view'  => Pages\ViewContact::route('/{record}'),
        ];
    }
}
