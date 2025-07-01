<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Filament\Resources\TransaksiResource\Widgets\TransaksiOverview;
use App\Models\Transaksi;
use App\Models\Katalog;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;


class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
        // Label navigasi
    protected static ?string $navigationLabel = 'Transaksi';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('katalog_id')
                    ->label('Katalog Produk')
                    ->options(function () {
                        return Katalog::all()->pluck('nama', 'id')->toArray();  // Retrieve product catalog data
                    })
                    ->required(),

                Select::make('user_id')
                    ->label('Pengguna')
                    ->options(function () {
                        return User::all()->pluck('name', 'id');  // Retrieve user data
                    })
                    ->required(),

                TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->required()
                    ->numeric()
                    ->rules(['min:0']),

                Textarea::make('additional')
                    ->label('Additional Info')
                    ->nullable()
                    ->maxLength(500),

                Select::make('status')
                    ->label('Status Transaksi')
                    ->options([
                        'belum bayar' => 'belum bayar',  // Yellow color for pending
                        'proses' => 'proses', // Green color for processing
                        'selesai' => 'selesai', // Green color for completed
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('katalog.nama')
                    ->label('Nama Produk')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->sortable(),

                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status Transaksi')
                    ->sortable()
                    ->color(function ($state) {
                        return match ($state) {
                            'belum bayar' => 'warning',  // Yellow color for pending
                            'lunas' => 'success', // Green color for completed
                            'proses' => 'success', // Green color for processing
                            'selesai' => 'success', // Green color for completed
                            'batal' => 'danger', // Red color for cancelled
                            default => 'secondary',  // Default gray color
                        };
                    }),

                TextColumn::make('additional')
                    ->label('Additional')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relations here if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TransaksiOverview::class,  // Ensure this widget is properly defined
        ];
    }
}
