<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturnStockResource\Pages;
use App\Filament\Resources\ReturnStockResource\RelationManagers;
use App\Models\ReturnStock;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\Checkbox;

class ReturnStockResource extends Resource
{
    protected static ?string $model = ReturnStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Loan Management';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Card::make()
                ->schema([
                    // ...
                    Select::make('loan_stock_id')  
                    ->relationship('loanStock', 'id'),      
                    Checkbox::make('isSucessful'),
                    
                ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('loanStock.id')->sortable(),
                TextColumn::make('isSucessful') ->sortable(),   
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListReturnStocks::route('/'),
            'create' => Pages\CreateReturnStock::route('/create'),
            'edit' => Pages\EditReturnStock::route('/{record}/edit'),
        ];
    }    
}
