<?php

namespace App\Filament\Resources\FoodMenuResource\Pages;

use App\Filament\Resources\FoodMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFoodMenu extends EditRecord
{
    protected static string $resource = FoodMenuResource::class;

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
