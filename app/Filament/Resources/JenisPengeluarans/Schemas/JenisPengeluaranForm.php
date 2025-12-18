<?php

namespace App\Filament\Resources\JenisPengeluarans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class JenisPengeluaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Jenis Pengeluaran')
                    ->required()
                    ->maxLength(100),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
