<?php

namespace App\Filament\Resources\Acaras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AcarasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->weight('bold'),
                TextColumn::make('waktu_mulai')->dateTime('d M Y H:i')->sortable(),
                TextColumn::make('lokasi'),
                // Menghitung jumlah yang hadir
                TextColumn::make('absensis_count')
                    ->counts('absensis')
                    ->label('Total Peserta'),
            ])
            ->filters([
                //
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
}
