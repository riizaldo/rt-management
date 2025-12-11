<?php

namespace App\Filament\Resources\Wargas\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;


class WargaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                static::getNamaFormField(),
                static::getNikFormField(),
                static::getKkFormField(),
                static::getJenisKelaminFormField(),
                static::getTanggalLahirFormField(),
                static::getAlamatFormField(),
                static::getNoRumahFormField(),
                static::getBlokRumahFormField(),
                static::getTeleponFormField(),
                static::getFotoKtpFormField(),
            ]);
    }

    public static function getNamaFormField(): TextInput
    {
        return TextInput::make('nama')
            ->label('Nama Lengkap')

            ->live()
            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)));
    }

    public static function getNikFormField(): TextInput
    {
        return TextInput::make('nik')
            ->label('NIK')

            ->maxLength(16);
    }

    public static function getKkFormField(): TextInput
    {
        return TextInput::make('kk')
            ->label('Nomor KK')
            ->maxLength(16);
    }

    public static function getJenisKelaminFormField(): Select
    {
        return Select::make('jenis_kelamin')
            ->label('Jenis Kelamin')
            ->options([
                'L' => 'Laki-Laki',
                'P' => 'Perempuan',
            ])
        ;
    }

    public static function getTanggalLahirFormField(): DatePicker
    {
        return DatePicker::make('tanggal_lahir')
            ->label('Tanggal Lahir');
    }

    public static function getAlamatFormField(): TextInput
    {
        return TextInput::make('alamat')
            ->label('Alamat');
    }

    public static function getNoRumahFormField(): TextInput
    {
        return TextInput::make('no_rumah')
            ->label('Nomor Rumah');
    }
    public static function getBlokRumahFormField(): TextInput
    {
        return TextInput::make('blok_rumah')
            ->label('Blok Rumah');
    }

    public static function getTeleponFormField(): TextInput
    {
        return TextInput::make('telepon')
            ->label('Telepon');
    }

    public static function getFotoKtpFormField(): FileUpload
    {
        return FileUpload::make('foto_ktp')
            ->label('Foto KTP')
            ->image()
            ->directory('foto-ktp');
    }
}
