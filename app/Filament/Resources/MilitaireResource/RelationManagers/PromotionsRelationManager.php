<?php

namespace App\Filament\Resources\MilitaireResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionsRelationManager extends RelationManager
{
    protected static string $relationship = 'promotions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grade_id')
                    ->label('Grade attribué')
                    ->relationship('grade', 'nom')
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('date_promotion')
                    ->label('Date de promotion')
                    ->required(),

                Forms\Components\TextInput::make('decision_numero')
                    ->label('N° de décision')
                    ->maxLength(255),

                Forms\Components\Textarea::make('commentaire')
                    ->label('Commentaire')
                    ->maxLength(500),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date_promotion')
            ->columns([
                Tables\Columns\TextColumn::make('grade.nom')
                    ->label('Grade'),

                Tables\Columns\TextColumn::make('date_promotion')
                    ->label('Date')
                    ->date('d/m/Y'),

                Tables\Columns\TextColumn::make('decision_numero')
                    ->label('N° Décision'),

                Tables\Columns\TextColumn::make('commentaire')
                    ->label('Commentaire')
                    ->limit(50),
            ])
            ->filters([])
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
