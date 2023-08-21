<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LossStockResource\Pages;
use App\Filament\Resources\LossStockResource\RelationManagers;
use App\Models\Approval;
use App\Models\LossStock;
use App\Models\returnStock;
use App\Models\User;
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
    protected static ?string $navigationGroup = 'Return Management';

    protected static ?int $navigationSort = 4;

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
                    $returnStockApprovalIds = returnStock::whereIn('approval_id', $approvedApprovalIds)->pluck('approval_id')->toArray();

                    // Combine the excluded approval IDs from both "loss stock" and "return stock"
                    $excludedApprovalIds = array_merge($lossStockApprovalIds, $returnStockApprovalIds);

                    // Retrieve approval records that are not in the excluded list
                    $approvalQuery = Approval::whereNotIn('id', $excludedApprovalIds);

                    return $approvalQuery->pluck('id', 'id');
                    })
                    ->reactive()
                    ->required(),  
                       
                    Select::make('user_id') 
                    ->label('Student/ Staff id')
                    ->options(function (callable $get) {
                        $selectedApprovalId = $get('approval_id'); // Get the previously selected value
                        
                        $options = []; // Default options

                        if ($selectedApprovalId) {
                            $selectedUser = Approval::find($selectedApprovalId);
                            if ($selectedUser) {
                                $options = Approval::where('id', $selectedUser->userId)
                                    ->pluck('userId', 'id');
                                    
                            }
                        }
                        return $options;
                    })
                    ->reactive() 
                    ->required(),

                    Select::make('username')
                    ->label('Student/Staff ID Number')
                    ->options(function (callable $get) {
                        $options = []; // Default options
                        $selectedUserID = $get('user_id'); // Get the previously selected value
                        
                        if ($selectedUserID) {
                            $selectedUser = User::find($selectedUserID);
                            if ($selectedUser) {
                                $options = User::where('id', $selectedUserID)
                                    ->pluck('username', 'id');
                            }
                        }
                        
                        return $options;})
                    ->required()
                    ->reactive(),

                    TextInput::make('lostType')
                    ->required(),
                    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                ->label('Loss Stock Id')
                ->sortable(),

                TextColumn::make('approval_id')
                ->label('Approval Id')
                ->sortable(),

                TextColumn::make('username')
                ->sortable()
                ->label('Student/ Staff ID')
                ->sortable(),


                TextColumn::make('lostType') 
                ->label('Loss Type')
                ->sortable(),  
                 
                TextColumn::make('created_at')
                ->label('Loss At')
                ->dateTime()
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
