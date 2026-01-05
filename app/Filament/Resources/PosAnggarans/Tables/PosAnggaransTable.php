<?php

namespace App\Filament\Resources\PosAnggarans\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;

class PosAnggaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('kode')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('mutasi_danas_sum_nominal')
                    ->label('Total Dana Terkumpul')
                    ->money('IDR') // Format Rupiah otomatis
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
