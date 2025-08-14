<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PaiesRelationManager extends RelationManager
{
    protected static string $relationship = 'paies';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('annee')
                    ->required()
                    ->maxLength(4)
                    ->numeric()
                    ->label('Année'),

                Forms\Components\DatePicker::make('date_paie')
                    ->required()
                    ->label('Date de la paie'),

                Forms\Components\TextInput::make('montant')
                    ->required()
                    ->numeric()
                    ->label('Montant')
                    ->rule('min:0'),

                Forms\Components\Select::make('type_paie')
                    ->options([
                        'mensuelle' => 'Mensuelle',
                        'exceptionnelle' => 'Exceptionnelle',
                        'prime' => 'Prime',
                    ])
                    ->required()
                    ->label('Type de paie'),

                Forms\Components\Toggle::make('valide')
                    ->label('Validé')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('annee')
            ->columns([
                Tables\Columns\TextColumn::make('annee')->label('Année')->sortable(),
                Tables\Columns\TextColumn::make('date_paie')->date()->label('Date de paie')->sortable(),
                Tables\Columns\TextColumn::make('montant')->label('Montant')->money('USD', true),
                Tables\Columns\TextColumn::make('type_paie')->label('Type')->sortable(),
                Tables\Columns\IconColumn::make('valide')->label('Validé')->boolean(),
            ])
            ->filters([
                Filter::make('annee')
                    ->form([
                        Forms\Components\TextInput::make('annee')
                            ->numeric()
                            ->maxLength(4)
                            ->placeholder('Année à filtrer'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['annee'], fn($q) => $q->where('annee', $data['annee']));
                    }),

                Filter::make('type_paie')
                    ->form([
                        Forms\Components\Select::make('type')
                            ->options([
                                'mensuelle' => 'Mensuelle',
                                'exceptionnelle' => 'Exceptionnelle',
                                'prime' => 'Prime',
                            ])
                            ->placeholder('Tous les types'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['type'], fn($q) => $q->where('type_paie', $data['type']));
                    }),

                Filter::make('date_paie_range')
                    ->form([
                        Forms\Components\DatePicker::make('date_debut')->label('Date début'),
                        Forms\Components\DatePicker::make('date_fin')->label('Date fin'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['date_debut'] && $data['date_fin']) {
                            return $query->whereBetween('date_paie', [$data['date_debut'], $data['date_fin']]);
                        }
                        return $query;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('valider_toutes')
                    ->label('Valider toutes les paies')
                    ->action(function () {
                        $this->getTableQuery()->update(['valide' => true]);
                        $this->notify('success', 'Toutes les paies ont été validées');
                    })
                    ->requiresConfirmation()
                    ->color('success'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('valider')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn ($record) => $record->update(['valide' => true]))
                    ->visible(fn ($record) => !$record->valide)
                    ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('valider_bulk')
                        ->label('Valider sélection')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['valide' => true]);
                            }
                            $this->notify('success', 'Paies sélectionnées validées');
                        })
                        ->color('success'),
                ]),
            ]);
    }
}
