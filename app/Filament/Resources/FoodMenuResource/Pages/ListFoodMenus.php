<?php

namespace App\Filament\Resources\FoodMenuResource\Pages;

use App\Filament\Resources\FoodMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFoodMenus extends ListRecords
{
    protected static string $resource = FoodMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Thêm Thực đơn'),
        ];
    }
}
