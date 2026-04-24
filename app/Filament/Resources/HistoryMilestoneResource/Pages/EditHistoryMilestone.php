<?php

namespace App\Filament\Resources\HistoryMilestoneResource\Pages;

use App\Filament\Resources\HistoryMilestoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoryMilestone extends EditRecord
{
    protected static string $resource = HistoryMilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Xóa'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
