<?php

namespace App\Filament\Resources\JourneyMilestones\Schemas;

use App\Models\JourneyMilestone;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JourneyMilestoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Milestone')
                    ->schema([
                        Select::make('type')
                            ->options(JourneyMilestone::TYPES)
                            ->required()
                            ->default('experience')
                            ->native(false)
                            ->helperText('Which tab this shows under on the homepage.'),

                        TextInput::make('year')
                            ->required()
                            ->maxLength(32)
                            ->placeholder('2024   or   2020–2024')
                            ->helperText('Free text — this is the little badge.'),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Display')
                    ->schema([
                        // max + 1 so a new milestone lands at the end of its tab rather than
                        // slotting into the middle wherever sort_order 0 happens to fall
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(fn (): int => (JourneyMilestone::max('sort_order') ?? -1) + 1)
                            ->helperText('Low numbers first, within its own tab. Or just drag the rows on the list.'),

                        Toggle::make('is_active')
                            ->label('Show on the site')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
