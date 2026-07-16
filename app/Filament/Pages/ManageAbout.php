<?php

namespace App\Filament\Pages;

use App\Models\About;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * The About Me section is a single row, so it gets an edit-in-place page rather than a
 * list / create / edit resource.
 */
class ManageAbout extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $navigationLabel = 'About Me';

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'About Me';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(About::current()->attributesToArray());
    }

    /**
     * Renders the form and its save button — the same shape EditRecord uses, so this page picks
     * up the panel's standard form chrome without a custom Blade view.
     */
    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make($this->getFormActions()),
                ]),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Heading')
                    ->schema([
                        TextInput::make('eyebrow')
                            ->required()
                            ->maxLength(255)
                            ->helperText('The small uppercase label above the heading.'),

                        TextInput::make('heading')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Text')
                    ->schema([
                        Textarea::make('lead')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('The bold opening line.')
                            ->columnSpanFull(),

                        Textarea::make('body')
                            ->rows(8)
                            ->helperText('Leave a blank line between paragraphs — each block becomes its own paragraph.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Photo')
                    ->description("A URL, not an upload — Vercel's filesystem is read-only, so an uploaded file would disappear on the next deploy.")
                    ->schema([
                        TextInput::make('image_url')
                            ->label('Photo URL')
                            ->maxLength(255)
                            ->helperText('A full URL, or a path to a file committed in public/ — e.g. assets/cjsheesh.png'),

                        TextInput::make('badge_text')
                            ->label('Badge')
                            ->maxLength(255)
                            ->helperText('The pill under the photo. Leave blank to hide it.'),
                    ])
                    ->columns(2),

                Section::make('Tech chips')
                    ->schema([
                        Repeater::make('chips')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->maxLength(60),

                                TextInput::make('icon')
                                    ->maxLength(60)
                                    ->placeholder('fa-brands fa-php')
                                    ->helperText('Font Awesome class. Optional.'),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add chip')
                            ->reorderable()
                            ->defaultItems(0),
                    ]),

                Section::make('Button')
                    ->schema([
                        TextInput::make('cta_label')
                            ->label('Button text')
                            ->maxLength(255)
                            ->helperText('Leave blank to hide the button.'),

                        TextInput::make('cta_url')
                            ->label('Button link')
                            ->maxLength(255)
                            ->placeholder('/about'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        About::current()->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('About Me updated')
            ->body('Reload the homepage to see it.')
            ->send();
    }
}
