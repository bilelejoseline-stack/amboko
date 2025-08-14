<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaieResource\Pages;
use App\Filament\Resources\PaieResource\RelationManagers;
use App\Models\Paie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class PaieResource extends Resource
{
    protected static ?string $model = Paie::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Gestion Militaire';
    protected static ?string $label = 'Paie';
    protected static ?string $pluralLabel = 'Paies';

    public static function form(Form $form): Form
    {
      return $form->schema([
          Select::make('militaire_id')
              ->label('Militaire')
              ->relationship('militaire', 'nom_complet')
              ->searchable()
              ->required(),

          TextInput::make('solde_base')
              ->numeric()
              ->required(),

          TextInput::make('prime_combat')
              ->numeric()
              ->default(0),

          TextInput::make('retenue')
              ->numeric()
              ->default(0),

          TextInput::make('net_a_payer')
              ->numeric()
              ->required(),

          DatePicker::make('mois')
              ->label('Mois de la paie')
              ->required(),

          TextInput::make('annee')
              ->numeric()
              ->minValue(2000)
              ->maxValue(now()->year)
              ->required(),
      ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('militaire.nom_complet')->label('Militaire')->searchable(),
            TextColumn::make('solde_base')->money('CDF', true)->sortable(),
            TextColumn::make('prime_combat')->money('CDF', true)->sortable(),
            TextColumn::make('retenue')->money('CDF', true)->sortable(),
            TextColumn::make('net_a_payer')->money('CDF', true)->sortable(),
            TextColumn::make('mois')->date('F Y')->label('Mois'),
            TextColumn::make('annee'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaies::route('/'),
            'create' => Pages\CreatePaie::route('/create'),
            'edit' => Pages\EditPaie::route('/{record}/edit'),
        ];
    }
}
