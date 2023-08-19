<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturnStockResource\Pages;
use App\Filament\Resources\ReturnStockResource\RelationManagers;
use App\Models\Approval;
use App\Models\lossStock;
use App\Models\ReturnStock;
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

use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

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
                        // Get all Return IDs with status having true boolean value
                    $approvedApprovalIds = Approval::where('status', true)->pluck('id')->toArray();

                    // Get Return IDs associated with "loss stock" records
                    $lossStockApprovalIds = LossStock::whereIn('approval_id', $approvedApprovalIds)->pluck('approval_id')->toArray();

                    // Get Return IDs associated with "return stock" records
                    $returnStockApprovalIds = ReturnStock::whereIn('approval_id', $approvedApprovalIds)->pluck('approval_id')->toArray();

                    // Combine the excluded Return IDs from both "loss stock" and "return stock"
                    $excludedApprovalIds = array_merge($lossStockApprovalIds, $returnStockApprovalIds);

                    // Retrieve Return records that are not in the excluded list
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
                                    ->pluck('userId', 'userId');
                                    
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

                    TextArea::make('remark')
                    ->label('Remarks'),
                    
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
                ->label('Returned Stock Id')
                ->sortable(),
                
                TextColumn::make('approval.id')
                ->label('Approval Id')
                ->sortable(),

                TextColumn::make('user_id')->sortable()
                ->label('Student/ Staff ID')
                ->sortable(),

                TextColumn::make('remark')
                ->label('Remarks')
                ->searchable(),

                TextColumn::make('created_at')
                ->label('Returned At')
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
            'index' => Pages\ListReturnStocks::route('/'),
            'create' => Pages\CreateReturnStock::route('/create'),
            'edit' => Pages\EditReturnStock::route('/{record}/edit'),
        ];
    }    
}
