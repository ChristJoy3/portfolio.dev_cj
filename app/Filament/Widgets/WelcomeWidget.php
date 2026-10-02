<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\ManageAbout;
use App\Filament\Pages\ManageSidebarProfile;
use App\Filament\Resources\JourneyMilestones\JourneyMilestoneResource;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Skills\SkillResource;
use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.welcome';

    protected function getViewData(): array
    {
        $hour = (int) now()->format('G');

        return [
            'greeting' => $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening'),
            'name' => auth()->user()?->name ?? 'there',
            'siteUrl' => url('/'),
            'actions' => [
                ['label' => 'New project', 'icon' => 'heroicon-o-plus-circle', 'url' => ProjectResource::getUrl('create')],
                ['label' => 'Edit About Me', 'icon' => 'heroicon-o-user', 'url' => ManageAbout::getUrl()],
                ['label' => 'Skills & Tools', 'icon' => 'heroicon-o-sparkles', 'url' => SkillResource::getUrl()],
                ['label' => 'Add milestone', 'icon' => 'heroicon-o-academic-cap', 'url' => JourneyMilestoneResource::getUrl('create')],
                ['label' => 'Sidebar profile', 'icon' => 'heroicon-o-identification', 'url' => ManageSidebarProfile::getUrl()],
            ],
        ];
    }
}
