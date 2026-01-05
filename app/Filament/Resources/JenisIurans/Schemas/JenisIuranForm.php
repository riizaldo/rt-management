<?php

namespace App\Filament\Resources\JenisIurans\Schemas;

use Filament\Forms;
use TextInput\Mask;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;


class JenisIuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getNamaField(),
            static::getNominalField(),
            static::getIsActiveField(),
            static::getDropping(),
        ]);
    }

    public static function getNamaField(): TextInput
    {
        return TextInput::make('nama')
            ->label('Nama Jenis Iuran')
            ->required()
            ->maxLength(255);
    }
    public static function getDropping(): Repeater
    {
        return Repeater::make('aturanAlokasis')
            ->relationship()
            ->schema([
                Select::make('pos_anggaran_id')
                    ->relationship('posAnggaran', 'nama')
                    ->required()
                    ->label('Masuk ke Pos'),

                Select::make('tipe')
                    ->options([
                        'persen' => 'Persentase (%)',
                        'fix' => 'Nominal Tetap (Rp)',
                    ])
                    ->default('persen')
                    ->live(), // Agar input bawah reaktif

                TextInput::make('nilai')
                    ->numeric()
                    ->label(fn($get) => $get('tipe') === 'persen' ? 'Besaran (%)' : 'Besaran (Rp)')
                    ->required(),
            ])
            ->columns(3)
        ;
    }

    public static function getNominalField(): TextInput
    {
        return TextInput::make('nominal')
            ->label('Nominal')
            ->numeric()
            ->required()
            ->prefix('Rp ');
    }

    public static function getIsActiveField(): Toggle
    {
        return Toggle::make('is_active')
            ->label('Aktif')
            ->default(true);
    }
}
