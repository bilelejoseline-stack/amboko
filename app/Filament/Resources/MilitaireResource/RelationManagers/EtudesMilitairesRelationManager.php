<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EtudesMilitairesRelationManager extends RelationManager
{
    protected static string $relationship = 'etudesMilitaires';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('etablissement')
                    ->label('Établissement militaire')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('lieu')
                    ->label('Lieu')
                    ->maxLength(255),

                Forms\Components\TextInput::make('diplome')
                    ->label('Diplôme ou grade obtenu')
                    ->maxLength(255),

                Forms\Components\DatePicker::make('date_debut')
                    ->label('Date de début')
                    ->required(),

                Forms\Components\DatePicker::make('date_fin')
                    ->label('Date de fin')
                    ->required(),

                Forms\Components\Textarea::make('remarques')
                    ->label('Remarques')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('etablissement')
            ->columns([
                Tables\Columns\TextColumn::make('etablissement')
                    ->label('Établissement')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lieu')
                    ->label('Lieu')
                    ->sortable(),

                Tables\Columns\TextColumn::make('diplome')
                    ->label('Diplôme')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_debut')
                    ->label('Début')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_fin')
                    ->label('Fin')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('remarques')
                    ->label('Remarques')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->remarques),
            ])
            ->filters([
                Tables\Filters\Filter::make('en_cours')
                    ->label('En cours')
                    ->query(fn (Builder $query) => $query->whereNull('date_fin')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
