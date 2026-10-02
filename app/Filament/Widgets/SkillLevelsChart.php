<?php

namespace App\Filament\Widgets;

use App\Models\SidebarSkill;
use Filament\Widgets\ChartWidget;

class SkillLevelsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = ['md' => 2, 'xl' => 7];

    protected ?string $heading = 'Skill levels';

    protected ?string $description = 'Your strongest skills, as shown in the sidebar.';

    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $skills = SidebarSkill::active()->whereIn('group', ['core', 'extended'])
            ->orderByDesc('level')->limit(10)->get();

        return [
            'datasets' => [[
                'label' => 'Level (%)',
                'data' => $skills->pluck('level')->all(),
                'backgroundColor' => '#0ea5e9',
                'borderRadius' => 6,
                'maxBarThickness' => 22,
            ]],
            'labels' => $skills->pluck('name')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => ['legend' => ['display' => false]],
            'scales' => [
                'x' => ['min' => 0, 'max' => 100, 'grid' => ['display' => false]],
                'y' => ['grid' => ['display' => false]],
            ],
        ];
    }
}
