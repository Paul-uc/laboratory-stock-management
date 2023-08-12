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
    protected static ?string $navigationGroup = 'Return Management';

    protected static ?int $navigationSort = 5;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Card::make()
                ->schema([
                    // ...
                    Select::make('approval_id')  
                    ->relationship('approval', 'id'),      
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
                TextColumn::make('approval.id')->sortable(),
                TextColumn::make('isSucessful')  ->boolean()
                ->label('Return Status')
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle')
                ->sortable(),      
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
