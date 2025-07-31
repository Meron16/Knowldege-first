<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('First name')
                ->required(),
                Forms\Components\TextInput::make('Last name')
                ->required(),
                Forms\Components\TextInput::make('Email')
                ->email()
                ->required(),
                Forms\Components\TextInput::make('Phone')
                ->email()
                ->required(),
                Forms\Components\Textarea::make('Message')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            ]);
    }

public static function table(Table $table): Table
{
    return $table
            ->columns([
            Tables\Columns\TextColumn::make('first_name')
                ->label('First Name') // this changes the column HEADER
                ->extraHeaderAttributes(['class' => 'text-2xl font-extrabold text-primary'])
                ->searchable(),


            Tables\Columns\TextColumn::make('last_name')
                ->label('Last Name')
                ->searchable(),


            Tables\Columns\TextColumn::make('email')
                ->label('Email Address')
                ->searchable()
                ->color('p')
                ->weight('medium'),

            Tables\Columns\TextColumn::make('phone')
                ->label('Phone Number')
                ->searchable()
                ->color('info'),

            Tables\Columns\TextColumn::make('message')
                ->label('Message')
                ->limit(50)
                ->searchable()
                ->wrap()
                ->color('gray'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make()
                ->label('')
                ->icon('heroicon-o-eye'),

            Tables\Actions\EditAction::make()
                ->label('')
                ->icon('heroicon-o-pencil'),

            Tables\Actions\DeleteAction::make()
                ->label('')
                ->icon('heroicon-o-trash'),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit')
            
        ];
    }
}
