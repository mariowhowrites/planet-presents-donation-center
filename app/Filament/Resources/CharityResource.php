<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharityResource\Pages;
use App\Filament\Resources\CharityResource\RelationManagers;
use App\Filament\Resources\CharityResource\RelationManagers\TiersRelationManager;
use App\Models\Charity;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharityResource extends Resource
{
    protected static ?string $model = Charity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('donation_url')
                    ->required()
                    ->label('Donation URL')
                    ->helperText('This is the URL that will be used to make donations to this charity.')
                    ->url()
                    ->maxLength(255),
                TextInput::make('charity_url')
                    ->required()
                    ->label('Charity URL')
                    ->helperText('This is the URL that will be used to link to this charity.')
                    ->url()
                    ->maxLength(255),
                FileUpload::make('preview_image')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/avif', 'image/webp'])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            TiersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharities::route('/'),
            'create' => Pages\CreateCharity::route('/create'),
            'edit' => Pages\EditCharity::route('/{record}/edit'),
        ];
    }

    public static function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
