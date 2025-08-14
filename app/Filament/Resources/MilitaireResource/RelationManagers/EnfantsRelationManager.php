<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class EnfantsRelationManager extends RelationManager
{
    protected static string $relationship = 'enfants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('postnom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_naissance')
                    ->required(),
                Forms\Components\TextInput::make('lieu_naissance')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('sexe')
                    ->options([
                        'M' => 'Masculin',
                        'F' => 'Féminin',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom')
            ->columns([
                Tables\Columns\TextColumn::make('nom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('postnom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('prenom')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date_naissance')->date()->sortable(),
                Tables\Columns\TextColumn::make('lieu_naissance')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sexe')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
