<?php

namespace App\Filament\Resources\Skills\Schemas;

use App\Models\Skill;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Skill')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Shown in the tooltip when the logo is hovered.'),

                        TextInput::make('href')
                            ->label('Link')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Where the logo links to. Leave blank for no link.'),

                        ColorPicker::make('accent')
                            ->required()
                            ->default('#00b0ff')
                            ->helperText('Hover glow and tooltip border colour.'),
                    ])
                    ->columns(2),

                Section::make('Icon')
                    ->description('Give it an image URL, or a Font Awesome class if no image exists. If both are filled, the image wins.')
                    ->schema([
                        TextInput::make('icon_url')
                            ->label('Icon image URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg')
                            ->helperText('Most logos live on devicon: .../icons/<name>/<name>-original.svg')
                            ->columnSpanFull(),

                        TextInput::make('icon_class')
                            ->label('Font Awesome class')
                            ->maxLength(255)
                            ->placeholder('fa-brands fa-github')
                            ->helperText('Only used when there is no image URL.'),

                        ColorPicker::make('icon_color')
                            ->label('Font Awesome colour')
                            ->helperText('Leave blank to follow the page colour — that is what keeps the GitHub mark readable in both light and dark themes.'),
                    ])
                    ->columns(2),

                Section::make('Display')
                    ->schema([
                        // max + 1 so a new skill lands at the end instead of wherever 0 happens to fall
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(fn (): int => (Skill::max('sort_order') ?? -1) + 1)
                            ->helperText('Low numbers first. Or just drag the rows on the list instead.'),

                        Toggle::make('is_active')
                            ->label('Show on the site')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
