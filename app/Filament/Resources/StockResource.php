<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Category;
use App\Models\Stock;
use App\Models\stockCode;
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
use Filament\Tables\Columns\IconColumn;
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
                    ->label('Category')
                    ->options(Category::all()->pluck('categoryName', 'id')->toArray())
                    ->reactive(), 

                    Select::make('stock_code_id')  
                    ->label('Stock Code')
                    ->options(function(callable $get){
                        $category = Category::find($get('category_id'));
                        if (!$category){
                            return stockCode::all()->pluck('code', 'id');
                        }
                        return $category->stockCode->pluck('code', 'id');
                    })
                    ->reactive(), 
                    
                    TextInput::make('serialNumber'),            

                    TextInput::make('stockDescription'),            
                 
                    DatePicker::make('warrantyEndDate'),
                    DatePicker::make('warrantyStartDate'),

                    TextInput::make('stockQuantity'),
                    TextInput::make('price'),

                    Checkbox::make('stockAvailability'),
                   
                ])->columns(2)
  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('Category.categoryName')->sortable(),               
                TextColumn::make('stockCode.code')->sortable(),                    
                TextColumn::make('serialNumber')->searchable()->sortable(),
                TextColumn::make('stockQuantity')->searchable()->sortable(),
                IconColumn::make('stockAvailability')  
                ->boolean()
                ->label('Ready to Loan')
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle')
                ->sortable(),   

                TextColumn::make('created_at')->dateTime('d-M-Y')->sortable(),
                
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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }    
}
