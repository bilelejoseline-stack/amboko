<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EtudesCivilesRelationManager extends RelationManager
{
    protected static string $relationship = 'etudesCiviles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('intitule')
                    ->label('Intitulé de l\'étude')
                    ->placeholder('Ex: Licence en Droit')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('institution')
                    ->label('Institution / Université')
                    ->placeholder('Ex: Université de Kinshasa')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('date_debut')
                    ->label('Date de début')
                    ->required(),

                Forms\Components\DatePicker::make('date_fin')
                    ->label('Date de fin')
                    ->nullable(),

                Forms\Components\Textarea::make('description')
                    ->label('Description / Remarques')
                    ->rows(3)
                    ->maxLength(500)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('intitule')
            ->columns([
                Tables\Columns\TextColumn::make('intitule')
                    ->label('Intitulé')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('institution')
                    ->label('Institution')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_debut')
                    ->label('Début')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_fin')
                    ->label('Fin')
                    ->date('d/m/Y')
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Remarques')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Exemple de filtre : études en cours
                Tables\Filters\Filter::make('en_cours')
                    ->label('En cours')
                    ->query(fn (Builder $query) => $query->whereNull('date_fin')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter étude civile'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Supprimer sélection'),
                ]),
            ]);
    }
}
