<?php

namespace App\Filament\Widgets;

use App\Models\JourneyMilestone;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SidebarSkill;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStats extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $projects = Project::count();
        $liveProjects = Project::active()->count();
        $skills = Skill::active()->count();
        $milestones = JourneyMilestone::active()->count();
        $avg = (int) round(SidebarSkill::active()->avg('level') ?? 0);

        $hiddenProjects = $projects - $liveProjects;

        return [
            Stat::make('Projects', $liveProjects)
                ->description($hiddenProjects ? "{$hiddenProjects} hidden of {$projects}" : 'All live on the site')
                ->descriptionIcon($hiddenProjects ? 'heroicon-m-eye-slash' : 'heroicon-m-check-circle')
                ->color($hiddenProjects ? 'warning' : 'success')
                ->chart($this->perMonth(Project::class)),

            Stat::make('Skills & tools', $skills)
                ->description('Logos in the icon cloud')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),

            Stat::make('Journey milestones', $milestones)
                ->description(JourneyMilestone::active()->where('type', 'experience')->count().' experience · '
                    .JourneyMilestone::active()->where('type', 'education')->count().' education')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Average skill level', $avg.'%')
                ->description(SidebarSkill::active()->count().' sidebar meters')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),
        ];
    }

    /** Rows created in each of the last 6 months, oldest first — drives the sparkline. */
    private function perMonth(string $model): array
    {
        return collect(range(5, 0))
            ->map(fn (int $ago) => $model::query()
                ->whereBetween('created_at', [now()->subMonths($ago)->startOfMonth(), now()->subMonths($ago)->endOfMonth()])
                ->count())
            ->all();
    }
}
