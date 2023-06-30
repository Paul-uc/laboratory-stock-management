<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanStockResource\Pages;
use App\Filament\Resources\LoanStockResource\RelationManagers;
use App\Models\LoanStock;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;


class LoanStockResource extends Resource
{
    protected static ?string $model = LoanStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    // ...
                    Select::make('stock_id')  
                    ->relationship('stock', 'id'),      
                    TextInput::make('loanRemark'),                       
                    DatePicker::make('estReturnDate'), 
                    
                ])
                //
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('stock.id')->sortable(),
                TextColumn::make('loanRemark') ->sortable(),  
                TextColumn::make('estReturnDate') ->sortable(),  
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLoanStocks::route('/'),
            'create' => Pages\CreateLoanStock::route('/create'),
            'edit' => Pages\EditLoanStock::route('/{record}/edit'),
        ];
    }    
}
