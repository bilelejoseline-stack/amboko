<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AffectationsRelationManager extends RelationManager
{
    protected static string $relationship = 'affectations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date_debut')
                    ->label('Date de début')
                    ->required(),

                Forms\Components\DatePicker::make('date_fin')
                    ->label('Date de fin')
                    ->nullable(),

                Forms\Components\TextInput::make('unite')
                    ->label('Unité')
                    ->maxLength(255)
                    ->required(),

                Forms\Components\TextInput::make('poste')
                    ->label('Poste occupé')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Textarea::make('lieu')
                    ->label('Lieu')
                    ->maxLength(500)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('unite')
            ->columns([
                Tables\Columns\TextColumn::make('date_debut')
                    ->label('Début')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_fin')
                    ->label('Fin')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('unite')
                    ->label('Unité')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('poste')
                    ->label('Poste')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lieu')
                    ->label('Lieu')
                    ->limit(30),
            ])
            ->filters([
                Tables\Filters\Filter::make('actives')
                    ->label('Affectations actives')
                    ->query(fn (Builder $query) => $query->whereNull('date_fin')),

                Tables\Filters\Filter::make('archivees')
                    ->label('Affectations terminées')
                    ->query(fn (Builder $query) => $query->whereNotNull('date_fin')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nouvelle affectation'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Modifier'),
                Tables\Actions\DeleteAction::make()
                    ->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Supprimer sélection'),
                ]),
            ]);
    }
}
