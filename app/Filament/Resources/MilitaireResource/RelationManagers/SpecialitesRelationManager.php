<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecialitesRelationManager extends RelationManager
{
    protected static string $relationship = 'specialites';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom_specialite')
                    ->label('Nom de la spécialité')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ex: Infanterie, Artillerie, Médecine militaire'),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->maxLength(65535)
                    ->placeholder('Détails sur cette spécialité...'),

                Forms\Components\DatePicker::make('date_obtention')
                    ->label('Date d’obtention')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->placeholder('Sélectionner une date'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nom_specialite')
            ->columns([
                Tables\Columns\TextColumn::make('nom_specialite')
                    ->label('Spécialité')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('date_obtention')
                    ->label('Date d’obtention')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Récemment ajoutées')
                    ->query(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth())),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter une spécialité'),
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
