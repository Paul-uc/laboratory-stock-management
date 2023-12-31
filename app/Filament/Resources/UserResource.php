<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Hash;
use Filament\Pages\Page;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Setting';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Section::make('Create New User')
                
                ->description('Please ensure the information entered is accurate and correct')
                ->aside()
                ->schema([
                    // ...
                    TextInput::make('name')
                    ->doesntEndWith(['admin'])
                    ->alpha()
                    ->required()
                    ->maxLength(255),
                    
               TextInput::make('username')
             
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                    FileUpload::make('avatar'),

                DatePicker::make('email_verified_at'),
               TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire) => ($livewire instanceof CreateUser))
                    ->maxLength(255),

                    Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload(),
                    Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->preload(),

                   
                ])
               
            ]);
    }


 
protected function onValidationError(ValidationException $exception): void
{
    Notification::make()
        ->title($exception->getMessage())
        ->danger()
        ->send();
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('name')->searchable()
                ->translateLabel(),
                TextColumn::make('username')->searchable()
                ->weight(FontWeight::Bold)
                ->translateLabel(),
                TextColumn::make('email')->searchable()
                ->translateLabel(),
                ImageColumn::make('avatar')
                ->label('Profile Image') 
                ->size(70)
                ->circular(), 
                TextColumn::make('roles.name')
                ->translateLabel()
                    ->sortable(),
                TextColumn::make('email_verified_at')
                ->translateLabel()
                ->icon('heroicon-m-calendar-days')
                    ->dateTime('d-M-Y')->sortable(),
               
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    } 

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('name', '!=', 'SuperAdmin');
    }
    
}
