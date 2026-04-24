<?php

namespace App\Filament\Resources\HistoryMilestoneResource\Pages;

use App\Filament\Resources\HistoryMilestoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoryMilestones extends ListRecords
{
    protected static string $resource = HistoryMilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Thêm Mốc lịch sử'),
        ];
    }
}
