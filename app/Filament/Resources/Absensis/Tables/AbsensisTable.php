<?php

namespace App\Filament\Resources\Absensis\Tables;

use App\Models\Acara;
use App\Models\Warga;
use App\Models\Absensi;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use App\Filament\Exports\AbsensiExporter;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextInputColumn;

class AbsensisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan Nama Warga
                TextColumn::make('warga.nama')
                    ->label('Nama Warga')
                    ->searchable()
                    ->sortable(),

                // INLINE EDITING: Ubah status langsung di tabel (Klik dropdownnya)
                SelectColumn::make('status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ])
                    ->selectablePlaceholder(false)
                    ->sortable(),

                // INLINE EDITING: Ketik keterangan langsung di tabel
                TextInputColumn::make('keterangan')
                    ->placeholder('Catatan...'),

                TextColumn::make('acara.nama')
                    ->label('Acara')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan default karena sudah ada di filter
            ])
            ->defaultSort('warga.nama', 'asc')
            ->filters([
                SelectFilter::make('acara_id')
                    ->label('Pilih Acara')
                    ->relationship('acara', 'nama')
                    ->searchable()
                    ->preload(),
            ])->headerActions([
                // 1. Tombol Generate Peserta
                Action::make('generate')
                    ->label('Generate Peserta')
                    ->icon('heroicon-o-users')
                    ->form([
                        Select::make('acara_id')
                            ->label('Pilih Acara yang akan digenerate')
                            ->options(Acara::all()->pluck('nama', 'id'))
                            ->required()
                            ->searchable(),
                    ])
                    ->action(function (array $data) {
                        $acaraId = $data['acara_id'];
                        $wargas = Warga::all(); // Ambil semua warga
                        $count = 0;

                        foreach ($wargas as $warga) {
                            // Cek duplikat, kalau belum ada baru buat
                            $exists = Absensi::where('acara_id', $acaraId)
                                ->where('warga_id', $warga->id)
                                ->exists();

                            if (!$exists) {
                                Absensi::create([
                                    'acara_id' => $acaraId,
                                    'warga_id' => $warga->id,
                                    'status' => 'alpa', // Default status
                                ]);
                                $count++;
                            }
                        }

                        Notification::make()->success()->title("$count Peserta ditambahkan")->send();
                    }),

                // 2. Tombol Export Excel
                ExportAction::make()
                    ->exporter(AbsensiExporter::class)
                    ->label('Export Data'),
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
