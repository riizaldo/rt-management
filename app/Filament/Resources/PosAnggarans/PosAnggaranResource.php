<?php

namespace App\Filament\Resources\PosAnggarans;

use App\Filament\Resources\PosAnggarans\Pages\CreatePosAnggaran;
use App\Filament\Resources\PosAnggarans\Pages\EditPosAnggaran;
use App\Filament\Resources\PosAnggarans\Pages\ListPosAnggarans;
use App\Filament\Resources\PosAnggarans\Schemas\PosAnggaranForm;
use App\Filament\Resources\PosAnggarans\Tables\PosAnggaransTable;
use App\Models\PosAnggaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PosAnggaranResource extends Resource
{
    protected static ?string $model = PosAnggaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Master';
    protected static ?string $recordTitleAttribute = 'pos anggaran';

    public static function form(Schema $schema): Schema
    {
        return PosAnggaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PosAnggaransTable::configure($table);
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
            'index' => ListPosAnggarans::route('/'),
            'create' => CreatePosAnggaran::route('/create'),
            'edit' => EditPosAnggaran::route('/{record}/edit'),
        ];
    }
}
