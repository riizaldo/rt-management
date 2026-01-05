<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class PengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                select::make('jenis_pengeluaran_id')
                    ->relationship('jenisPengeluaran', 'nama')
                    ->label('Jenis Pengeluaran')
                    ->required(),
                TextInput::make('nominal')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal'),
                TextInput::make('keterangan'),
            ]);
    }
}
