<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;


class UserResource extends Resource
{


    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
 public static function getNavigationGroup(): ?string
    {
        return 'User Management';
    }
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
           Select::make('role')
           ->label('Role')
           ->options([
            'admin' => 'Admin',
             'user' => 'User',
            ])
    ->visible(function () {
        return auth()->user()?->role === 'admin';
    })
    ->required(fn () => auth()->user()?->role === 'admin'),  
            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                ->dehydrated(fn ($state) => filled($state))
                ->label('Password')
                ->visibleOn('create'),
                
        ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('role')->searchable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->label('')->icon('heroicon-o-eye'),
            Tables\Actions\EditAction::make()->label('')->icon('heroicon-o-pencil'),
            Tables\Actions\DeleteAction::make()->label('')->icon('heroicon-o-trash'),
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
            'view' => Pages\ViewUser::route('/{record}'),

        ];
    }
    public static function canCreate(): bool
{
    return auth()->user()?->role === 'admin';
}

public static function canEdit($record): bool
{
    return auth()->user()?->role === 'admin';
}

public static function canDelete($record): bool
{
    return auth()->user()?->role === 'admin';
}
public static function getNavigationBadge(): ?string
    {
        return static:: getModel()::count();
    }
}
