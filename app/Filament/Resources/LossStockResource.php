<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LossStockResource\Pages;
use App\Filament\Resources\LossStockResource\RelationManagers;
use App\Models\LossStock;
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

use Filament\Forms\Components\TextInput;

class LossStockResource extends Resource
{
    protected static ?string $model = LossStock::class;

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
                    TextInput::make('lostType'),
                    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('loan_stock.id')->sortable(),
                TextColumn::make('lostType') ->sortable(),   
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
            'index' => Pages\ListLossStocks::route('/'),
            'create' => Pages\CreateLossStock::route('/create'),
            'edit' => Pages\EditLossStock::route('/{record}/edit'),
        ];
    }    
}
