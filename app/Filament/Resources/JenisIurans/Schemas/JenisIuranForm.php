<?php

namespace App\Filament\Resources\JenisIurans\Schemas;

use Filament\Forms;
use TextInput\Mask;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;


class JenisIuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getNamaField(),
            static::getNominalField(),
            static::getIsActiveField(),
        ]);
    }

    public static function getNamaField(): TextInput
    {
        return TextInput::make('nama')
            ->label('Nama Jenis Iuran')
            ->required()
            ->maxLength(255);
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
