<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectTagsChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = ['md' => 2, 'xl' => 5];

    protected ?string $heading = 'Tech across projects';

    protected ?string $description = 'How often each tag appears on a live project.';

    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $counts = Project::active()->get()
            ->flatMap(fn (Project $p) => $p->tags ?? [])
            ->countBy()->sortDesc()->take(6);

        return [
            'datasets' => [[
                'data' => $counts->values()->all(),
                'backgroundColor' => ['#0ea5e9', '#6366f1', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'],
                'borderWidth' => 0,
            ]],
            'labels' => $counts->keys()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'cutout' => '65%',
            'plugins' => ['legend' => ['position' => 'bottom']],
            'scales' => ['x' => ['display' => false], 'y' => ['display' => false]],
        ];
    }
}
