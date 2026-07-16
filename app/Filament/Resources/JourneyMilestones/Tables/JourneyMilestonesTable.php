<?php

namespace App\Filament\Resources\JourneyMilestones\Tables;

use App\Models\JourneyMilestone;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JourneyMilestonesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => JourneyMilestone::TYPES[$state] ?? $state)
                    ->color(fn (string $state): string => $state === 'education' ? 'info' : 'success')
                    ->sortable(),

                TextColumn::make('year')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->wrap(),

                ToggleColumn::make('is_active')
                    ->label('Live'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(JourneyMilestone::TYPES),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
