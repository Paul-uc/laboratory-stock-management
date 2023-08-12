<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturnStockResource\Pages;
use App\Filament\Resources\ReturnStockResource\RelationManagers;
use App\Models\Approval;
use App\Models\lossStock;
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
use Filament\Tables\Columns\IconColumn;

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
                    ->label('Approval ID')
                    ->options(function (callable $get) {
                        // Get all approval IDs with status having true boolean value
                    $approvedApprovalIds = Approval::where('status', true)->pluck('id')->toArray();

                    // Get approval IDs associated with "loss stock" records
                    $lossStockApprovalIds = LossStock::whereIn('approval_id', $approvedApprovalIds)->pluck('approval_id')->toArray();

                    // Get approval IDs associated with "return stock" records
                    $returnStockApprovalIds = ReturnStock::whereIn('approval_id', $approvedApprovalIds)->pluck('approval_id')->toArray();

                    // Combine the excluded approval IDs from both "loss stock" and "return stock"
                    $excludedApprovalIds = array_merge($lossStockApprovalIds, $returnStockApprovalIds);

                    // Retrieve approval records that are not in the excluded list
                    $approvalQuery = Approval::whereNotIn('id', $excludedApprovalIds);

                    return $approvalQuery->pluck('id', 'id');
                    })
                    ->reactive()
                    ->required(),

                

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
                IconColumn::make('isSucessful')  ->boolean()
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
