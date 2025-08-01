<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsMediaResource\Pages;
use App\Filament\Resources\NewsMediaResource\RelationManagers;
use App\Models\NewsMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsMediaResource extends Resource
{
    

    protected static ?string $model = NewsMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('headline')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('video_link')
                    ->maxLength(255),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('headline')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('video_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
    Tables\Actions\ViewAction::make()
        ->label('') // Hide text label
        ->icon('heroicon-o-eye'),

    Tables\Actions\EditAction::make()
        ->label('') // Hide text label
        ->icon('heroicon-o-pencil'),

    Tables\Actions\DeleteAction::make()
        ->label('') // Hide text label
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
            'index' => Pages\ListNewsMedia::route('/'),
            'create' => Pages\CreateNewsMedia::route('/create'),
            'edit' => Pages\EditNewsMedia::route('/{record}/edit'),
            'view' => Pages\ViewNewsMedia::route('/{record}'),
           


        ];
    }
    public static function getNavigationLabel(): string
   {
        return 'News and Media';
   }  
       public static function getNavigationGroup(): ?string
    {
    return 'Media Library';
    }
    public static function canDelete($record): bool
{
    return auth()->user()?->role === 'admin';
}


}
