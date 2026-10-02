<?php

namespace App\Filament\Resources\SidebarSkills\Pages;

use App\Filament\Resources\SidebarSkills\SidebarSkillResource;
use App\Models\SidebarSkill;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSidebarSkills extends ManageRecords
{
    protected static string $resource = SidebarSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // max + 1 so a new row lands at the end of its group instead of at 0
            CreateAction::make()->mutateDataUsing(function (array $data): array {
                $data['sort_order'] = (SidebarSkill::max('sort_order') ?? -1) + 1;

                return $data;
            }),
        ];
    }
}
