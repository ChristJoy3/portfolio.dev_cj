<?php

namespace App\Filament\Resources\JourneyMilestones;

use App\Filament\Resources\JourneyMilestones\Pages\CreateJourneyMilestone;
use App\Filament\Resources\JourneyMilestones\Pages\EditJourneyMilestone;
use App\Filament\Resources\JourneyMilestones\Pages\ListJourneyMilestones;
use App\Filament\Resources\JourneyMilestones\Schemas\JourneyMilestoneForm;
use App\Filament\Resources\JourneyMilestones\Tables\JourneyMilestonesTable;
use App\Models\JourneyMilestone;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JourneyMilestoneResource extends Resource
{
    protected static ?string $model = JourneyMilestone::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'My Journey';

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return JourneyMilestoneForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JourneyMilestonesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJourneyMilestones::route('/'),
            'create' => CreateJourneyMilestone::route('/create'),
            'edit' => EditJourneyMilestone::route('/{record}/edit'),
        ];
    }
}
