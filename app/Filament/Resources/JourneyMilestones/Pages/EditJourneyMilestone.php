<?php

namespace App\Filament\Resources\JourneyMilestones\Pages;

use App\Filament\Resources\JourneyMilestones\JourneyMilestoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJourneyMilestone extends EditRecord
{
    protected static string $resource = JourneyMilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
