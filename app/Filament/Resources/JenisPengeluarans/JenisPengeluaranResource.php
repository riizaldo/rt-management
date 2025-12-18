<?php

namespace App\Filament\Resources\JenisPengeluarans;

use App\Filament\Resources\JenisPengeluarans\Pages\CreateJenisPengeluaran;
use App\Filament\Resources\JenisPengeluarans\Pages\EditJenisPengeluaran;
use App\Filament\Resources\JenisPengeluarans\Pages\ListJenisPengeluarans;
use App\Filament\Resources\JenisPengeluarans\Schemas\JenisPengeluaranForm;
use App\Filament\Resources\JenisPengeluarans\Tables\JenisPengeluaransTable;
use App\Models\JenisPengeluaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisPengeluaranResource extends Resource
{
    protected static ?string $model = JenisPengeluaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Master';
    protected static ?string $recordTitleAttribute = 'Jenis Pengeluaran';

    public static function form(Schema $schema): Schema
    {
        return JenisPengeluaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisPengeluaransTable::configure($table);
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
            'index' => ListJenisPengeluarans::route('/'),
            'create' => CreateJenisPengeluaran::route('/create'),
            'edit' => EditJenisPengeluaran::route('/{record}/edit'),
        ];
    }
}
