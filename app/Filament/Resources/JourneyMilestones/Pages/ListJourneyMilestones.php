<?php

namespace App\Filament\Resources\JourneyMilestones\Pages;

use App\Filament\Resources\JourneyMilestones\JourneyMilestoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJourneyMilestones extends ListRecords
{
    protected static string $resource = JourneyMilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
