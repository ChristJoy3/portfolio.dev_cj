<?php

namespace App\Filament\Pages;

use App\Models\Resume;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
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
 * The CV page is a single row, so — like ManageAbout — it gets an edit-in-place page.
 */
class ManageResume extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'CV / Resume';

    protected static string|\UnitEnum|null $navigationGroup = 'Pages';

    protected static ?string $title = 'CV / Resume';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Resume::current()->attributesToArray());
    }

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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view')
                ->label('View CV')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->color('gray')
                ->url(url('/cv'), shouldOpenInNewTab: true),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Header')
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('headline')->maxLength(255)->helperText('Your title, e.g. Web Developer.'),
                        TextInput::make('location')->maxLength(255),
                        TextInput::make('phone')->maxLength(60),
                        TextInput::make('email')->email()->maxLength(255),
                        TextInput::make('website')->maxLength(255)->placeholder('portfolio-devcj.vercel.app'),
                    ])
                    ->columns(2),

                Section::make('Professional summary')
                    ->schema([
                        Textarea::make('summary')->hiddenLabel()->rows(6)->columnSpanFull(),
                    ]),

                Section::make('Technical skills')
                    ->description('One row per group, e.g. Front-end → HTML5, CSS3, JavaScript.')
                    ->schema([
                        Repeater::make('skills')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('label')->required()->maxLength(80)->placeholder('Front-end'),
                                TextInput::make('items')->required()->maxLength(500)->placeholder('HTML5, CSS3, JavaScript'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->addActionLabel('Add skill group')
                            ->reorderable()
                            ->collapsible()
                            ->defaultItems(0),
                    ]),

                Section::make('Work experience')
                    ->schema([
                        Repeater::make('experience')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('role')->required()->maxLength(255)->placeholder('Web Developer (Project-Based)'),
                                TextInput::make('period')->maxLength(60)->placeholder('2024 – Present'),
                                TextInput::make('organization')->maxLength(255)->placeholder('CreativeDevLabs'),
                                TextInput::make('details')->label('Address / extra')->maxLength(255),
                                Textarea::make('bullets')
                                    ->label('Bullet points')
                                    ->rows(7)
                                    ->helperText('One bullet per line.')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['role'] ?? null)
                            ->addActionLabel('Add job')
                            ->reorderable()
                            ->collapsible()
                            ->defaultItems(0),
                    ]),

                Section::make('Education')
                    ->schema([
                        Repeater::make('education')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('degree')->required()->maxLength(255),
                                TextInput::make('period')->maxLength(60)->placeholder('Graduated 2026'),
                                TextInput::make('school')->maxLength(255)->columnSpanFull(),
                                Textarea::make('highlights')
                                    ->rows(3)
                                    ->helperText('Awards or notes — one per line.')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['degree'] ?? null)
                            ->addActionLabel('Add education')
                            ->reorderable()
                            ->collapsible()
                            ->defaultItems(0),
                    ]),

                Section::make('Soft skills')
                    ->schema([
                        TagsInput::make('soft_skills')->hiddenLabel()->helperText('Press Enter after each one.'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Save changes')->submit('save'),
        ];
    }

    public function save(): void
    {
        Resume::current()->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('CV updated')
            ->body('Reload the CV page to see it.')
            ->send();
    }
}
