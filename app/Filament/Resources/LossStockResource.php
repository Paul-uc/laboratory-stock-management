<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LossStockResource\Pages;
use App\Filament\Resources\LossStockResource\RelationManagers;
use App\Models\Approval;
use App\Models\Category;
use App\Models\LossStock;
use App\Models\returnStock;
use App\Models\stockCode;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;

class LossStockResource extends Resource
{
    protected static ?string $model = LossStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Return Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Loss Stock Management')
                ->description('Please ensure the penalty has been paid')
                ->aside()
                ->schema([
          
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
                                        ->pluck('userId', 'id');
                                        
                                }
                            }
                            return $options;
                        })
                        ->reactive() 
                        ->required(),
    
                      
    
                        
                        Select::make('stock_id') 
                        ->label('Stock id')
                        ->options(function (callable $get) {
                            $selectedApprovalId = $get('approval_id'); // Get the previously selected value
                            
                            $options = [];
    
                            if ($selectedApprovalId) {
                                $selectedUser = Approval::find($selectedApprovalId);
                                if ($selectedUser) {
                                    $options = Approval::where('id', $selectedUser->stock_id)
                                        ->pluck('stock_id', 'id');
                                        
                                }
                            }
                            return $options;
                        })
                        ->reactive() 
                        ->required(),
                        
    
                    Select::make('userId')
                        ->label('Student/Staff ID')
                        ->options(function (callable $get) {
                            $selectedLoanStockId = $get('approval_id'); // Get the previously selected loan_stock_id
    
                            $options = [];
    
                            if ($selectedLoanStockId) {
                                $selectedLoanStock = loanStock::find($selectedLoanStockId);
    
                                if ($selectedLoanStock) {
                                    $selectedUserId = $selectedLoanStock->userId; // Assuming there's a userId column in the LoanStock model
    
                                    if ($selectedUserId) {
                                        $user = User::find($selectedUserId); // Assuming User model exists with a 'username' attribute
                                        if ($user) {
                                            $formattedOption = "{$user->username} ";
                                            $options[$selectedUserId] = $formattedOption;
                                        }
                                    }
                                }
                            }
    
                            return $options;
                        })
                        ->reactive()
                        ->required(),
    
    
                    TextInput::make('name')
                        ->label('Supervisor Name')
                        ->required(),
    
                    TextInput::make('position')
                        ->label('Position')
                        ->required(),
    
                    TextInput::make('remark')
                        ->label('Remark'),
    
                        
                    Checkbox::make('status')
                    ->label('Payment Status')
                    ->columnSpan('full'),
    
    
                    ])
                    
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                
               
                TextColumn::make('stock_id'),
                TextColumn::make('stock.serialNumber')
                ->label('Stock Serial Number') ,
                
             
                TextColumn::make('name')
                    ->label('Supervisor Name')
                    ->weight(FontWeight::Bold)
                    ->sortable(),

                TextColumn::make('position')->sortable(),
                TextColumn::make('remark')->sortable()
                ->label('Loss Destination'),
                TextColumn::make('created_at')->dateTime()
                ->label('Loss At')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Send pdf')
                ->icon('heroicon-o-paper-airplane')
                ->url(fn (LossStock $record) => route('returnStock.download', $record))
                ->openUrlInNewTab(),

            Action::make('Dowload pdf')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn (LossStock $record) => route('returnStock.pdf.download', $record))
                ->openUrlInNewTab(),
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
