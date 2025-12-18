<?php

namespace App\Filament\Resources\JenisPengeluarans\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class JenisPengeluaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Jenis Pengeluaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('keterangan')
                    ->limit(40),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])->defaultSort('nama')
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
