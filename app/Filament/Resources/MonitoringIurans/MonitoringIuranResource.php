<?php

namespace App\Filament\Resources\MonitoringIurans;

use App\Filament\Resources\MonitoringIurans\Pages\CreateMonitoringIuran;
use App\Filament\Resources\MonitoringIurans\Pages\EditMonitoringIuran;
use App\Filament\Resources\MonitoringIurans\Pages\ListMonitoringIurans;
use App\Filament\Resources\MonitoringIurans\Pages\ViewMonitoringIuran;
use App\Filament\Resources\MonitoringIurans\Schemas\MonitoringIuranForm;
use App\Filament\Resources\MonitoringIurans\Schemas\MonitoringIuranInfolist;
use App\Filament\Resources\MonitoringIurans\Tables\MonitoringIuransTable;
use App\Models\Warga;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MonitoringIuranResource extends Resource
{
    protected static ?string $model = Warga::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Wargas';
    protected static ?string $navigationLabel = 'Monitoring Iuran';
    protected static ?string $slug = 'monitoring-iuran'; // URL jadi /admin/monitoring-iuran
    protected static ?string $breadcrumb = 'Monitoring';
    public static function form(Schema $schema): Schema
    {
        return MonitoringIuranForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MonitoringIuranInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonitoringIuransTable::configure($table);
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
            'index' => ListMonitoringIurans::route('/'),
            'create' => CreateMonitoringIuran::route('/create'),
            'view' => ViewMonitoringIuran::route('/{record}'),
            'edit' => EditMonitoringIuran::route('/{record}/edit'),
        ];
    }
}
