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
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

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
                Card::make()
                ->schema([
                    // ...
                    Select::make('category_id')  
                    ->relationship('category', 'categoryName'), 
                    TextInput::make('code')
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
            'index' => Pages\ListStockCodes::route('/'),
            'create' => Pages\CreateStockCode::route('/create'),
            'edit' => Pages\EditStockCode::route('/{record}/edit'),
        ];
    }    
}
