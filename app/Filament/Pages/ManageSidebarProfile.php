<?php

namespace App\Filament\Pages;

use App\Filament\Forms\ImageUpload;
use App\Models\SidebarProfile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
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
 * The sidebar profile card is a single row, so — like ManageAbout — it gets an edit-in-place page.
 */
class ManageSidebarProfile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $navigationLabel = 'Sidebar Profile';

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 5;

    protected static ?string $title = 'Sidebar Profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SidebarProfile::current()->attributesToArray());
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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('tagline')
                            ->maxLength(255)
                            ->helperText('The line under your name, e.g. React.js | PHP | Node/Express.'),

                        ImageUpload::make('image_url')
                            ->label('Photo')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Contact')
                    ->description('Leave a field blank to hide it.')
                    ->schema([
                        TextInput::make('address')
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Footer links')
                    ->description('The links at the bottom of the sidebar. Add as many as you like; remove them all to hide the footer.')
                    ->schema([
                        Repeater::make('links')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->maxLength(60)
                                    ->placeholder('GitHub'),

                                TextInput::make('url')
                                    ->label('Link')
                                    ->required()
                                    ->url()
                                    ->maxLength(255)
                                    ->placeholder('https://github.com/you'),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add link')
                            ->reorderable()
                            ->defaultItems(0),
                    ]),
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
        SidebarProfile::current()->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('Sidebar profile updated')
            ->body('Reload the homepage to see it.')
            ->send();
    }
}
