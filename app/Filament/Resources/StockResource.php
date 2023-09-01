<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Category;
use App\Models\Stock;
use App\Models\stockCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
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
use Filament\Forms\Components\Wizard;




class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Stock Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Wizard::make([
                    Wizard\Step::make('Select Stock Category')
                    ->description('Select stock Category for the new Stock')
                        ->icon('heroicon-m-wrench')
                        ->columns(1)
                        ->schema([
                            // ...
                            Select::make('category_id')  
                            ->label('Category')
                            ->options(Category::all()->pluck('categoryName', 'id')->toArray())
                            ->reactive()
                            ->required(), 
        
                            Select::make('stock_code_id')  
                            ->label('Stock Code')
                            ->options(function(callable $get){
                                $category = Category::find($get('category_id'));
                                if (!$category){
                                    return stockCode::all()->pluck('code', 'id');
                                }
                                return $category->stockCode->pluck('code', 'id');
                            })
                            ->reactive()
                            ->required(), 
                        ]),
                    Wizard\Step::make('Enter Stock Details ')
                    ->description('Enter Stock Details for the new stock')
                        ->icon('heroicon-m-wrench')
                        ->columns(1)
                        ->schema([
                            // ...
                            TextInput::make('serialNumber') ->required()->string(),            
                           
                            DatePicker::make('warrantyStartDate') ->before('first day of next month')->required(),                                    
                            DatePicker::make('warrantyEndDate')->after('warrantyStartDate') ->required(),
                           
                        ]),
                    Wizard\Step::make('Enter Stock Quantity ')
                    ->description('Enter the quantity of Stock')
                        ->icon('heroicon-m-wrench')
                        ->columns(1)
                        ->schema([
                            // ...
                          
                            TextInput::make('price') ->required()->numeric(),
                            Checkbox::make('stockAvailability') ->required(),
                        ]),
                ])->columnSpan('full')
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
               
                IconColumn::make('stockAvailability')  
                ->boolean()
                ->label('Ready to Loan')
                ->trueIcon('heroicon-o-check-badge')
                ->falseIcon('heroicon-o-x-circle')
                ->sortable(),   
                TextColumn::make('price')->sortable(),
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
