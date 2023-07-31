<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Stock;
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
use Filament\Forms\Components\Checkbox;

use Filament\Resources\Forms\Components;




class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive';
    protected static ?string $navigationGroup = 'Stock Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()
                ->schema([
                    // ...
                    Select::make('category_id')  
                    ->relationship('category', 'name'),      
                    TextInput::make('stockQuantity'),
                    TextInput::make('stockDescription'),
                    DatePicker::make('warrantyDate'),
                    TextInput::make('price'),
                    Checkbox::make('stockAvailability'),
                   
                ])
  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('Category.name')->sortable(),
                TextColumn::make('stockQuantity')->searchable()->sortable(),
                TextColumn::make('stockDescription')->searchable()->sortable(),
                TextColumn::make('price')->searchable()->sortable(),
                TextColumn::make('stockAvailability') ->sortable(),   
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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }    
}
