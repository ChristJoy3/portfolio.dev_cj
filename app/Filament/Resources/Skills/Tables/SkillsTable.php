<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order') // drag rows to reorder the sphere
            ->columns([
                ImageColumn::make('icon_url')
                    ->label('Icon')
                    ->height(32)
                    ->placeholder('—'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('icon_class')
                    ->label('FA class')
                    ->placeholder('—')
                    ->toggleable(),

                ColorColumn::make('accent')
                    ->label('Accent'),

                ToggleColumn::make('is_active')
                    ->label('Live'),
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
