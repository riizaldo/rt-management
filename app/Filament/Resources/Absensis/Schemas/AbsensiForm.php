<?php

namespace App\Filament\Resources\Absensis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class AbsensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getNamaField(),
            static::getAcaraField(),
            static::getWargaField(),
            static::getStatusField(),
            static::getKeteranganField(),
        ]);
    }
    public static function getNamaField()
    {
        return TextInput::make('nama')
            ->required()
            ->columnSpanFull();
    }
    public static function getAcaraField()
    {
        return Select::make('acara_id')
            ->relationship('acara', 'nama')
            ->required();
    }
    public static function getWargaField()
    {
        return Select::make('warga_id')
            ->relationship('warga', 'nama')
            ->searchable()
            ->required();
    }
    public static function getStatusField()
    {
        return Select::make('status')
            ->options(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'])
            ->default('hadir');
    }
    public static function getKeteranganField()
    {
        return TextInput::make('keterangan');
    }
}
