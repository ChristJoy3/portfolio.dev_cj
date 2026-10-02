<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestProjects extends TableWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent projects';

    public function table(Table $table): Table
    {
        return $table
            ->query(Project::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                ImageColumn::make('image_url')
                    ->label('')
                    ->state(fn (Project $record) => $record->imageSrc())
                    ->height(40)
                    ->extraImgAttributes(['class' => 'rounded-md object-cover']),

                TextColumn::make('title')
                    ->weight('medium')
                    ->description(fn (Project $record): ?string => str($record->description)->limit(70)->toString() ?: null),

                TextColumn::make('tags')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('Added')
                    ->since(),

                ToggleColumn::make('is_active')
                    ->label('Live'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Project $record): string => ProjectResource::getUrl('edit', ['record' => $record])),
            ])
            ->headerActions([
                Action::make('all')
                    ->label('All projects')
                    ->icon('heroicon-m-arrow-right')
                    ->url(ProjectResource::getUrl()),
            ])
            ->emptyStateHeading('No projects yet')
            ->emptyStateIcon('heroicon-o-rectangle-stack');
    }
}
