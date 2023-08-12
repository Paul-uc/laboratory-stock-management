<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalResource\Pages;
use App\Filament\Resources\ApprovalResource\RelationManagers;
use App\Models\Approval;
use App\Models\loanStock;
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
                    ->label('Loan Stock ID')
                    ->options(function () {
                        // Get all loan stock IDs
                        $allLoanStockIds = LoanStock::pluck('id');
                
                        // Get the IDs of approved loan stock records
                        $approvedLoanIds = Approval::pluck('loan_stock_id');
                
                        // Filter out the approved loan stock IDs
                        $unapprovedLoanStockIds = $allLoanStockIds->diff($approvedLoanIds);
                
                        // Fetch the loan stock records for the unapproved IDs
                        $unapprovedLoanStock = LoanStock::whereIn('id', $unapprovedLoanStockIds)->get();
                
                        // Create options with unapproved loan stock records
                        $options = $unapprovedLoanStock->pluck('id', 'id');
                
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
                    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->sortable(),
                TextColumn::make('loanStock.id')->sortable(),
                IconColumn::make('status')
                ->boolean()
                ->label('Approval Status')
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle')
                ->sortable(),   
                TextColumn::make('name') ->sortable(), 
                TextColumn::make('position') ->sortable(),   
                TextColumn::make('remark') ->sortable(),     
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
