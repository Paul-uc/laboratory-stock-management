<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalResource\Pages;
use App\Filament\Resources\ApprovalResource\RelationManagers;
use App\Models\Approval;
use App\Models\loanStock;
use App\Models\Stock;
use App\Models\stockCode;
use App\Models\User;
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

use Filament\Forms\Components\Checkbox;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;

class ApprovalResource extends Resource
{
    protected static ?string $model = Approval::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Loan Management';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()
                    ->schema([
                        // ...            
                        Select::make('loan_stock_id')

                            ->label('Loan Stock Serial Number')
                            ->options(function () {
                                // Get IDs from LoanStock model
                                $loanStockIds = LoanStock::pluck('id');

                                // Get loan_stock_id values from Approval model
                                $approvalLoanStockIds = Approval::pluck('loan_stock_id');

                                // Compare and find the difference in IDs
                                $availableLoanStockIds = $loanStockIds->diff($approvalLoanStockIds);

                                // Retrieve loan_stock_id that hasn't been registered in Approval model
                                $availableLoanStockIds = $availableLoanStockIds->all();

                                // Format the IDs to serial number form
                                $options = [];
                                foreach ($availableLoanStockIds as $loanStockId) {
                                    $stock = Stock::find($loanStockId); // Assuming Stock model has the serial number
                                    if ($stock) {
                                        $formattedOption = "{$stock->serialNumber} ";
                                        $options[$loanStockId] = $formattedOption;
                                    }
                                }
                               
                                return $options;
                                
                            })
                            ->reactive()
                            ->required(),

                            Select::make('stock_id')

                            ->label('Loan Stock Serial Number')
                            ->options(function(callable $get){
                                $stockCode = stockCode::find($get('stock_code_id'));
                                if (!$stockCode){
                                    return Stock::all()->pluck('serialNumber', 'id');
                                }
                                return $stockCode->stock->pluck('serialNumber', 'id');
                            })
                            ->relationship('stock','serialNumber')
                            ->label('Serial Number')
                            ->required(),
                            

                        Select::make('userId')
                            ->label('Student/Staff ID')
                            ->options(function (callable $get) {
                                $selectedLoanStockId = $get('loan_stock_id'); // Get the previously selected loan_stock_id

                                $options = [];

                                if ($selectedLoanStockId) {
                                    $selectedLoanStock = LoanStock::find($selectedLoanStockId);

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


                        Checkbox::make('status')
                            ->label('Approval Status'),

                        TextInput::make('name')
                            ->label('Supervisor Name')
                            ->required(),

                        TextInput::make('position')
                            ->label('Position')
                            ->required(),

                        TextInput::make('remark')
                            ->label('Remark'),

                        ]),
                    
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                
               
                TextColumn::make('loan_stock_id'),
                TextColumn::make('stock.serialNumber')
                ->label('Stock Serial Number') ,
                
                IconColumn::make('status')
                    ->boolean()
                    ->label('Approval Status')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Supervisor Name')
                    ->sortable(),

                TextColumn::make('position')->sortable(),
                TextColumn::make('remark')->sortable(),
                TextColumn::make('created_at')->dateTime()
                ->label('Approved At')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Send pdf')
                ->icon('heroicon-o-paper-airplane')
                ->url(fn (Approval $record) => route('approval.download', $record))
                ->openUrlInNewTab(),

                Action::make('Dowload pdf')
                ->icon('heroicon-o-document-download')
                ->url(fn (Approval $record) => route('approval.pdf.download', $record))
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
            'index' => Pages\ListApprovals::route('/'),
            'create' => Pages\CreateApproval::route('/create'),
            'edit' => Pages\EditApproval::route('/{record}/edit'),
        ];
    }
}
