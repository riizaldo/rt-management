<?php

namespace App\Filament\Resources\Iurans\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;

class IuransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('warga.nama')
                    ->label('Warga')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('warga')
                    ->label('Rumah')
                    ->getStateUsing(
                        fn($record) =>
                        "{$record->warga->blok_rumah}{$record->warga->no_rumah}"
                    ),

                TextColumn::make('jenis.nama')
                    ->label('Jenis Iuran')
                    ->sortable(),

                TextColumn::make('bulan')
                    ->label('Bulan')
                    ->formatStateUsing(fn($state) => self::bulanLabel($state))
                    ->sortable(),

                TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'lunas',
                        'danger'  => 'belum',
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => 'lunas',
                        'heroicon-o-clock'       => 'belum',
                    ]),
            ])
            ->filters([
                SelectFilter::make('bulan')
                    ->options(self::bulanOptions()),

                SelectFilter::make('tahun')
                    ->options(
                        fn() => collect(range(now()->year - 2, now()->year + 2))
                            ->mapWithKeys(fn($y) => [$y => $y])
                    ),

                SelectFilter::make('status')
                    ->options([
                        'lunas' => 'Lunas',
                        'belum' => 'Belum',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
    protected static function bulanOptions(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    protected static function bulanLabel(int $bulan): string
    {
        return self::bulanOptions()[$bulan] ?? '-';
    }
}
