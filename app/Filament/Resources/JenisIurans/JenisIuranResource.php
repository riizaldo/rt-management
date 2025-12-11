<?php

namespace App\Filament\Resources\JenisIurans;

use App\Filament\Resources\JenisIurans\Pages\CreateJenisIuran;
use App\Filament\Resources\JenisIurans\Pages\EditJenisIuran;
use App\Filament\Resources\JenisIurans\Pages\ListJenisIurans;
use App\Filament\Resources\JenisIurans\Schemas\JenisIuranForm;
use App\Filament\Resources\JenisIurans\Tables\JenisIuransTable;
use App\Models\JenisIuran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisIuranResource extends Resource
{
    protected static ?string $model = JenisIuran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Master';
    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return JenisIuranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisIuransTable::configure($table);
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
            'index' => ListJenisIurans::route('/'),
            'create' => CreateJenisIuran::route('/create'),
            'edit' => EditJenisIuran::route('/{record}/edit'),
        ];
    }
}
