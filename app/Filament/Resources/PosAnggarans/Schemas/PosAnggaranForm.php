<?php

namespace App\Filament\Resources\PosAnggarans\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class PosAnggaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getNamaField(),
            static::getCodeField(),
        ]);
    }

    public static function getNamaField(): TextInput
    {
        return TextInput::make('nama')
            ->required()
            ->maxLength(255)
            ->label('Nama Pos');
    }
    public static function getCodeField(): TextInput
    {
        return TextInput::make('kode')
            ->maxLength(10)
            ->placeholder('Contoh: KAS-RT')
            ->label('Kode Singkatan')
            ->unique(ignoreRecord: true);
    }
    public static function getKeteranganField(): Textarea
    {
        return Textarea::make('keterangan')
            ->columnSpanFull();
    }
    public static function getToggleField(): Toggle
    {
        return Toggle::make('is_active')
            ->label('Aktif?')
            ->default(true);
    }
}
