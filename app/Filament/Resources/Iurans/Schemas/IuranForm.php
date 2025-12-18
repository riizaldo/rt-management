<?php

namespace App\Filament\Resources\Iurans\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\BelongsToSelect; // <- penting
use App\Models\JenisIuran;
use App\Models\Warga;

class IuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            static::getWargaField(),
            static::getJenisIuranField(),
            static::getNominalField(),
            static::getBulanField(),
            static::getTahunField(),
            static::getStatusField(),
            // static::getBuktiBayarField(),
        ]);
    }

    public static function getWargaField()
    {
        return select::make('warga_id')
            ->relationship('warga', 'nama')
            ->label('Warga')
            ->getOptionLabelFromRecordUsing(
                fn(Warga $record) =>
                "{$record->blok_rumah}{$record->no_rumah}-{$record->nama}  "
            )
            ->required();
    }


    public static function getJenisIuranField()
    {
        return select::make('jenis_iuran_id')
            ->relationship('jenis', 'nama')
            ->label('Jenis Iuran')
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set) {
                $jenis = JenisIuran::find($state);
                if ($jenis) {
                    $set('nominal', $jenis->nominal);
                }
            });
    }


    public static function getNominalField(): TextInput
    {
        return TextInput::make('nominal')
            ->label('Nominal')
            ->numeric()
            ->prefix('Rp ')
            ->required();
    }

    public static function getBulanField(): Select
    {
        return Select::make('bulan')
            ->label('Bulan')
            ->options([
                '1' => 'Januari',
                '2' => 'Februari',
                '3' => 'Maret',
                '4' => 'April',
                '5' => 'Mei',
                '6' => 'Juni',
                '7' => 'Juli',
                '8' => 'Agustus',
                '9' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ])
            ->required();
    }

    public static function getTahunField(): TextInput
    {
        return TextInput::make('tahun')
            ->label('Tahun')
            ->default(now()->year)
            ->numeric()
            ->required();
    }

    public static function getStatusField(): Select
    {
        return Select::make('status')
            ->label('Status')
            ->options([
                'lunas' => 'Lunas',
                'belum' => 'Belum',
            ])
            ->default('belum')
            ->required();
    }

    public static function getBuktiBayarField(): FileUpload
    {
        return FileUpload::make('bukti_bayar')
            ->label('Bukti Bayar')
            ->directory('bukti-iuran')
            ->image();
    }
}
