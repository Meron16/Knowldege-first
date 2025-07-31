<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerRegistrationResource\Pages;
use App\Models\VolunteerRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VolunteerRegistrationResource extends Resource
{
    protected static ?string $model = VolunteerRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')->required(),
            Forms\Components\TextInput::make('last_name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('phone')->required(),
            Forms\Components\TextInput::make('country_code')->required(),
            Forms\Components\TextInput::make('position')->required(),
            Forms\Components\TextInput::make('volunteer_location')->required(),
            Forms\Components\DatePicker::make('start_date')->required(),
            Forms\Components\TextInput::make('cv_link')->url()->nullable(),
            Forms\Components\FileUpload::make('file_upload')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('first_name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('last_name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('position'),
            Tables\Columns\TextColumn::make('volunteer_location'),
            Tables\Columns\TextColumn::make('start_date')->date(),
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
            'index' => Pages\ListVolunteerRegistrations::route('/'),
            'create' => Pages\CreateVolunteerRegistration::route('/create'),
            'edit' => Pages\EditVolunteerRegistration::route('/{record}/edit'),
        ];
    }
    public static function getNavigationGroup(): ?string
{
    return 'Registration';
}

}
