<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CemgResource\Pages;
use App\Filament\Resources\CemgResource\RelationManagers;
use App\Models\Cemg;
use App\Models\Militaire;
use App\Models\RoleCemg;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CemgResource extends Resource
{
    protected static ?string $model = Cemg::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    //protected static ?string $navigationGroup = 'Haut Commandement';
    protected static ?int $navigationSort = 1;
    protected static ?string $pluralModelLabel = 'CEMG';
    protected static ?string $modelLabel = 'CEMG';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('militaire_id')
                ->label('Militaire')
                ->options(Militaire::query()->pluck('nom', 'id'))
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Nom du CEMG')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('role_id')
                ->label('Rôle')
                ->options(RoleCemg::query()->pluck('name', 'id'))
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->maxLength(65535),

            Forms\Components\Toggle::make('active')
                ->label('Actif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('militaire.nom')
                ->label('Militaire')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('role.name')
                ->label('Rôle')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->limit(50),

            Tables\Columns\IconColumn::make('active')
                ->label('Actif')
                ->boolean(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime()
                ->sortable(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCemgs::route('/'),
            'create' => Pages\CreateCemg::route('/create'),
            'edit' => Pages\EditCemg::route('/{record}/edit'),
        ];
    }
}
