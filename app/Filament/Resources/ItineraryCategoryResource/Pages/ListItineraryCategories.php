<?php

namespace App\Filament\Resources\ItineraryCategoryResource\Pages;

use App\Filament\Resources\ItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItineraryCategories extends ListRecords
{
    protected static string $resource = ItineraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
