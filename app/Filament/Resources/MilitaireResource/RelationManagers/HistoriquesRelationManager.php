<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriquesRelationManager extends RelationManager
{
    protected static string $relationship = 'historiques';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_evenement')
                    ->label('Date de l\'événement')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                Forms\Components\TextInput::make('type_evenement')
                    ->label('Type d\'événement')
                    ->placeholder('Ex: Promotion, Mutation, Mission, Récompense')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('lieu')
                    ->label('Lieu')
                    ->placeholder('Ville, Région ou Base')
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->placeholder('Détails de l’événement...')
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type_evenement')
            ->columns([
                Tables\Columns\TextColumn::make('date_evenement')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type_evenement')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lieu')
                    ->label('Lieu')
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_evenement')
                    ->label('Filtrer par type')
                    ->options([
                        'Promotion' => 'Promotion',
                        'Mutation' => 'Mutation',
                        'Mission' => 'Mission',
                        'Récompense' => 'Récompense',
                        'Sanction' => 'Sanction',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter un événement'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Supprimer la sélection'),
                ]),
            ]);
    }
}
