<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
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
class PaymentResource extends Resource
{
    // Model terkait
    protected static ?string $model = Payment::class;

    // Ikon navigasi
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    // Label navigasi
    protected static ?string $navigationLabel = 'Payment';
    
    // Grup navigasi
    protected static ?string $navigationGroup = 'Transaction';
    
    // Urutan navigasi
    protected static ?int $navigationSort = 2; // Pastikan ini nullable dengan ?int
    public static function getLabel(): string
    {
        return 'Payment';  // Mengganti label resource menjadi "Payment"
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('midtrans_order_id')
                ->label('Midtrans Order ID')
                ->required()
                ->maxLength(50),
            
            Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'settlement' => 'Settlement',
                    'failed' => 'Failed',
                ])
                ->default('pending')
                ->required(),

            TextInput::make('payment_type')
                ->label('Payment Type')
                ->required()
                ->maxLength(20),

            TextArea::make('payment_url')
                ->label('Payment URL')
                ->required()
                ->maxLength(255),

            // Relation with transaksi table
            Select::make('transaksi_id')
                ->label('Transaksi ID')
                ->options(function () {
                    return \App\Models\Transaksi::all()->pluck('order_id', 'id');
                })
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('midtrans_order_id')->searchable(),
                TextColumn::make('status')->sortable()->searchable(),
                TextColumn::make('payment_type')->sortable()->searchable(),
                TextColumn::make('payment_url')->limit(50),
                TextColumn::make('transaksi.order_id')->label('Transaksi Order ID')->sortable(),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([/* filters */])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
