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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Wizard;
use Filament\Support\Enums\FontWeight;


class LoanStockResource extends Resource
{
    protected static ?string $model = LoanStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Loan Management';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Wizard\Step::make('Stock Category')
                        ->description('Select Loan Stock Category')
                        ->icon('heroicon-m-wrench')
                        ->columns(1)
                        ->schema([
                            // ...
                            Select::make('category_id')
                                ->label('Category')
                                ->options(Category::all()->pluck('categoryName', 'id')->toArray())
                                ->reactive()
                                ->required(),
                            Select::make('stock_code_id')
                                ->label('Stock Code')
                                ->options(function (callable $get) {
                                    $category = Category::find($get('category_id'));
                                    if (!$category) {
                                        return stockCode::all()->pluck('code', 'id');
                                    }
                                    return $category->stockCode->pluck('code', 'id');
                                })
                                ->reactive()
                                ->required(),

                                Select::make('stock_id')
                                ->label('Stock Serial Number')
                                ->options(function (callable $get) {
                                    $category = stockCode::find($get('category_id'));
                                   
                                    if (!$category) {
                                        return Stock::all()->pluck('serialNumber', 'id');
                                    }
                                    return $category->stock->pluck('serialNumber', 'id');
                                })
                                ->reactive()
                                ->required(),
                                
                        ]),

                    Wizard\Step::make('Select User')
                        ->description('Select Loan Stock User')
                        ->icon('heroicon-m-user')
                        ->columns(1)
                        ->schema([
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

                        ]),
                    Wizard\Step::make('Enter User Details')
                        ->description('Enter all User Details')
                        ->icon('heroicon-m-identification')                 
                        ->columns(1)
                        ->schema([
                            // ...
                            TextInput::make('email')
                                ->label('Email address')
                                ->email()
                                ->required(),
                            TextInput::make('phoneNumber')
                                ->label('Phone Number')
                                ->tel()
                                ->prefix('60+')->required(),
                            TextInput::make('supervisorName')
                            ->string()
                                ->label('TAR UMT supervisor(s) or lecturer(s) name involved in approved project (if applicable)')->required(),
                                

                            DatePicker::make('startLoanDate')
                                ->label('Start Loan Date')
                                ->required(),

                            DatePicker::make('estReturnDate')
                                ->after('startLoanDate')
                                ->label('Estimated Return Date')
                                ->after('startLoanDate')
                                ->required(),

                            TextArea::make('reason')
                                ->label('Reason to Loan')
                                ->alphaNum()
                                ->required(),

                            Checkbox::make('termsAndCondition')
                                ->label('By ticking, I hereby agree with the Terms and Conditions')
                                ->required()
                                ->columnSpan('full'),
                        ]),

                ])->columnSpan('full'),
                // ...       
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('stock.serialNumber')
                    ->label('Serial Number')
                    ->sortable(),
                TextColumn::make('stockCode.code')->sortable(),


                TextColumn::make('user.username')->sortable()
                    ->label('Student/ Staff ID')
                    ->weight(FontWeight::Bold)
                    ->sortable(),

                TextColumn::make('estReturnDate')
                ->dateTime('d-M-Y')->sortable() ->icon('heroicon-m-calendar-days'),

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
