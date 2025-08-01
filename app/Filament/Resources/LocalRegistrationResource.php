<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocalRegistrationResource\Pages;
use App\Models\LocalRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LocalRegistrationResource extends Resource
{
    protected static ?string $model = LocalRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
 return $form->schema([
            Forms\Components\TextInput::make('first_name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('last_name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('country_code')
                ->label('Country Code (e.g. +251)')
                ->required()
                ->maxLength(10),
            Forms\Components\TextInput::make('phone')
                ->required()
                ->maxLength(20),
            Forms\Components\Select::make('course_level')
                ->options([
                    'Diploma' => 'Diploma',
                    'Undergraduate' => 'Undergraduate',
                    'Postgraduate' => 'Postgraduate',
                ])
                ->required(),
            Forms\Components\Select::make('student_type')
                ->options([
                    'Highschool Student' => 'Highschool Student',
                    'University Student' => 'University Student',
                    'Graduate' => 'Graduate',
                ])
                ->required(),
            Forms\Components\Select::make('registration_type')
                ->options([
                    'Tuition' => 'Tuition',
                    'Boarding' => 'Boarding',
                    'Both' => 'Both',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('first_name')->searchable(),
            Tables\Columns\TextColumn::make('last_name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('country_code')->label('Country Code'),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('course_level'),
            Tables\Columns\TextColumn::make('student_type'),
            Tables\Columns\TextColumn::make('registration_type'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->label('')->icon('heroicon-o-eye'),
            Tables\Actions\EditAction::make()->label('')->icon('heroicon-o-pencil'),
            Tables\Actions\DeleteAction::make()->label('')->icon('heroicon-o-trash'),
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
            'index' => Pages\ListLocalRegistrations::route('/'),
            'create' => Pages\CreateLocalRegistration::route('/create'),
            'edit' => Pages\EditLocalRegistration::route('/{record}/edit'),
        ];
    }
    public static function getNavigationGroup(): ?string
{
    return 'Registration';
}


}
