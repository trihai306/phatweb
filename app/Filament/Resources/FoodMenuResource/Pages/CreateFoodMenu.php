<?php

namespace App\Filament\Resources\FoodMenuResource\Pages;

use App\Filament\Resources\FoodMenuResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodMenu extends CreateRecord
{
    protected static string $resource = FoodMenuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
