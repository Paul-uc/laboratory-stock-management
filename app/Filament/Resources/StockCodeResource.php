<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockCodeResource\Pages;
use App\Filament\Resources\StockCodeResource\RelationManagers;
use App\Models\StockCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

class StockCodeResource extends Resource
{
    protected static ?string $model = StockCode::class;

   
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Stock Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Enter New Asset Code')
                ->description('Please ensure the information entered is accurate and correct')
                ->aside()
                ->schema([
                    // ...
                    Select::make('category_id')  
                    ->relationship('category', 'categoryName')->required()->label('Selectcategory'), 

                    TextInput::make('code')
                    ->required()
                    ->string(),
                 
                    TextInput::make('stockDescription') ->alphaNum()->required()->label('Asset Description'),
                ])
                ->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('Category.categoryName')->label('Category Name')->sortable(),       
                TextColumn::make('code')->label('Stock Code')->searchable()->sortable(),
                TextColumn::make('serial_numbers_count')->label('Stock Quantity')
                ->searchable()
                ->sortable() 
                ->counts('serial_numbers'),
                TextColumn::make('stockDescription')->label('Stock Description')->searchable()->sortable(),
                TextColumn::make('created_at')->dateTime('d-M-Y')->sortable() ->icon('heroicon-m-calendar-days'),
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
            'index' => Pages\ListStockCodes::route('/'),
            'create' => Pages\CreateStockCode::route('/create'),
            'edit' => Pages\EditStockCode::route('/{record}/edit'),
        ];
    }    
}
