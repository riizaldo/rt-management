<?php

namespace App\Filament\Resources\JenisPengeluarans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

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
                Select::make('pos_anggaran_id')
                    ->label('Ambil Dana Dari Pos')
                    ->relationship('posAnggaran', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Setiap pengeluaran jenis ini akan mengurangi saldo pos yang dipilih.'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
