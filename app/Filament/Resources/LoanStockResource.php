<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanStockResource\Pages;
use App\Filament\Resources\LoanStockResource\RelationManagers;
use App\Models\LoanStock;
use App\Models\Category;
use App\Models\Stock;
use App\Models\stockCode;
use App\Models\User;
use Filament\Forms\Components\Textarea;

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


class LoanStockResource extends Resource
{
    protected static ?string $model = LoanStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Loan Management';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    // ...       
                    Select::make('category_id')  
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id')->toArray())
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

                    Select::make('stock_id')  
                    ->options(function(callable $get){
                        $stockCode = stockCode::find($get('stock_code_id'));
                        if (!$stockCode){
                            return Stock::all()->pluck('serialNumber', 'id');
                        }
                        return $stockCode->stock->pluck('serialNumber', 'id');
                    })
                    ->label('Serial Number')
                    ->required(),
                    

                    
                    Select::make('user_id')  
                    ->label('Student/ Staff name')
                    ->options(User::all()->pluck('name', 'id')->toArray())
                    ->reactive() 
                    ->required(),

                    Select::make('userId') 
                    ->label('Student/ Staff id')
                    ->options(function (callable $get) {
                        $selectedUserId = $get('user_id'); // Get the previously selected value
                
                        $options = User::all()->pluck('username', 'id'); // Default options
                        
                        if ($selectedUserId) {
                            $selectedUser = User::find($selectedUserId);
                            if ($selectedUser) {
                                $options = User::where('id', $selectedUser->id)
                                    ->pluck('username', 'id');
                            }
                        }
                        
                        return $options;
                    })
                    ->reactive() 
                    ->required(),
                    
                    
                    TextInput::make('email')
                    ->label('Email address')
                    ->email(), 
                    TextInput::make('phoneNumber')
                    ->label('Phone Number')
                    ->tel()
                    ->prefix('60+'), 
                    TextInput::make('supervisorName') 
                    ->label('TAR UMT supervisor(s) or lecturer(s) name involved in approved project (if applicable)') ,

                    DatePicker::make('startLoanDate')
                    ->label('Start Loan Date'),
                    
                    DatePicker::make('estReturnDate')
                    ->label('Estimated Return Date'),
                    
                    TextArea::make('reason')
                    ->label('Reason to Loan')
                    ->columnSpan(2)
                    ,
                    

                   
                  
                    
                    Checkbox::make('termsAndCondition')
                    ->label('By ticking, I hereby agree with the Terms and Conditions')
                    ->required()
                    ,
                    
                    
                    
                ])->columns(2)
                //
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('stock.serialNumber')->sortable(),
                TextColumn::make('stockCode.code')->sortable(),
                
               
                TextColumn::make('user.username')->sortable()
                ->label('Student/ Staff ID')
                ->sortable(), 

                TextColumn::make('estReturnDate')->sortable(), 
               
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
            'index' => Pages\ListLoanStocks::route('/'),
            'create' => Pages\CreateLoanStock::route('/create'),
            'edit' => Pages\EditLoanStock::route('/{record}/edit'),
        ];
    }    
}
