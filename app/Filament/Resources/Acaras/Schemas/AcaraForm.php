<?php

namespace App\Filament\Resources\Acaras\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;

class AcaraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getNamaField(),
            static::getWaktuMulaiField(),
            static::getWaktuSelesaiField(),
            static::getLokasiField(),
            static::getKeteranganField(),
        ]);
    }
    public static function getNamaField()
    {
        return TextInput::make('nama')
            ->required()
            ->columnSpanFull();
    }
    public static function getWaktuMulaiField()
    {
        return DateTimePicker::make('waktu_mulai')
            ->required();
    }
    public static function getWaktuSelesaiField()
    {
        return DateTimePicker::make('waktu_selesai')
            ->required();
    }
    public static function getLokasiField()
    {
        return TextInput::make('lokasi');
    }
    public static function getKeteranganField()
    {
        return Textarea::make('keterangan')->columnSpanFull();
    }
}
