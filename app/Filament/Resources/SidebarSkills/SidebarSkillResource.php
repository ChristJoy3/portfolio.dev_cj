<?php

namespace App\Filament\Resources\SidebarSkills;

use App\Filament\Resources\SidebarSkills\Pages\ManageSidebarSkills;
use App\Models\SidebarSkill;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SidebarSkillResource extends Resource
{
    protected static ?string $model = SidebarSkill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Sidebar Skill Levels';

    protected static ?string $modelLabel = 'skill level';

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('level')
                ->label('Percent')
                ->required()
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->suffix('%')
                ->default(50),

            Select::make('group')
                ->options(SidebarSkill::GROUPS)
                ->required()
                ->default('extended')
                ->helperText('Where it appears in the sidebar.'),

            Toggle::make('is_active')
                ->label('Show on the site')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('level')->label('Percent')->suffix('%')->sortable(),
                TextColumn::make('group')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => SidebarSkill::GROUPS[$state] ?? $state),
                ToggleColumn::make('is_active')->label('Live'),
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

    public static function getPages(): array
    {
        return [
            'index' => ManageSidebarSkills::route('/'),
        ];
    }
}
