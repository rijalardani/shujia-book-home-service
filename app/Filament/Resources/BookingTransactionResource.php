<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\BookingTransaction;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Product and Price')
                        ->completedIcon('heroicon-m-hand-thumb-up')
                        ->description('Add your product items')
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                Forms\Components\Repeater::make('transactionDetails')
                                ->relationship('transactionDetails')
                                ->schema([
                                    
                                ])
                            ])
                        ])

                ])
                ->columnSpan('full')
                ->columns(1)
                ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
