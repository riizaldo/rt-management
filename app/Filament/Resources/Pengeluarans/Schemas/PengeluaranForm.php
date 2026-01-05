<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_pengeluaran_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nominal')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal'),
                TextInput::make('keterangan'),
            ]);
    }
}
