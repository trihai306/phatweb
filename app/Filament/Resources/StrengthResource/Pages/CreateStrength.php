<?php

namespace App\Filament\Resources\StrengthResource\Pages;

use App\Filament\Resources\StrengthResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStrength extends CreateRecord
{
    protected static string $resource = StrengthResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
