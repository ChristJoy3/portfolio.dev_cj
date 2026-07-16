<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('demo_url')
                            ->label('Live demo link')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Leave blank to hide the "Live Demo" button.'),

                        TextInput::make('repo_url')
                            ->label('GitHub link')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Leave blank to hide the "GitHub" button.'),

                        Textarea::make('description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        TagsInput::make('tags')
                            ->helperText('Press Enter after each one. These are the small pills on the card.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Image')
                    ->description("A URL, not an upload — Vercel's filesystem is read-only, so an uploaded file would disappear on the next deploy.")
                    ->schema([
                        TextInput::make('image_url')
                            ->label('Image URL')
                            ->maxLength(255)
                            ->placeholder('https://images.unsplash.com/photo-...?w=600&q=80')
                            ->helperText('Any public image URL. To use your own file, commit it to public/assets/ and enter: assets/your-file.jpg')
                            ->columnSpanFull(),
                    ]),

                Section::make('Display')
                    ->schema([
                        // max + 1 so a new project lands at the end instead of wherever 0 happens to fall
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(fn (): int => (Project::max('sort_order') ?? -1) + 1)
                            ->helperText('Low numbers first. Or just drag the rows on the list instead.'),

                        Toggle::make('is_active')
                            ->label('Show on the site')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
