<?php

namespace App\Filament\Resources\ItineraryCategoryResource\Pages;

use App\Filament\Resources\ItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItineraryCategory extends EditRecord
{
    protected static string $resource = ItineraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
