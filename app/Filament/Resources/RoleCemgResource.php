<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleCemgResource\Pages;
use App\Filament\Resources\RoleCemgResource\RelationManagers;
use App\Models\RoleCemg;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleCemgResource extends Resource
{
    protected static ?string $model = RoleCemg::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    //protected static ?string $navigationGroup = 'Haut Commandement';
    protected static ?int $navigationSort = 0;
    protected static ?string $modelLabel = 'Rôle CEMG';
    protected static ?string $pluralModelLabel = 'Rôles CEMG';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom du rôle')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('cemg.name')
                ->label('CEMG attribué')
                ->default('-')
                ->sortable(),
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
            'index' => Pages\ListRoleCemgs::route('/'),
            'create' => Pages\CreateRoleCemg::route('/create'),
            'edit' => Pages\EditRoleCemg::route('/{record}/edit'),
        ];
    }
}
