<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoArmyResource\Pages;
use App\Models\InfoArmy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, BooleanColumn, BadgeColumn};

class InfoArmyResource extends Resource
{
    protected static ?string $model = InfoArmy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Communications';

    protected static ?string $label = 'Information défilante';
    protected static ?string $pluralLabel = 'Bandes défilantes';

    // Ne montrer le menu qu'aux super-admins — doit être PUBLIC !
    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('title')
                    ->label('Catégorie')
                    ->options([
                        'alerte' => 'Alerte',
                        'politique' => 'Politique',
                        'sport' => 'Sport',
                        'magazine' => 'Magazine',
                        'nécrologie' => 'Nécrologie',
                        'sécurité' => 'Sécurité',
                        'autre' => 'Autre',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('message')
                    ->label('Message')
                    ->rows(4)
                    ->required(),

                Forms\Components\Toggle::make('active')
                    ->label('Actif')
                    ->default(true),

                Forms\Components\TextInput::make('priority')
                    ->label('Priorité')
                    ->numeric()
                    ->default(0)
                    ->helperText('Plus petit = plus prioritaire'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('title')->label('Catégorie')->colors([
                    'danger' => 'alerte',
                    'info' => 'politique',
                    'success' => 'sport',
                    'warning' => 'magazine',
                    'gray' => 'nécrologie',
                ]),
                TextColumn::make('message')->label('Message')->limit(50)->wrap(),
                BooleanColumn::make('active')->label('Actif'),
                TextColumn::make('priority')->label('Priorité')->sortable(),
                TextColumn::make('created_at')->label('Ajouté le')->dateTime('d/m/Y à H:i'),
            ])
            ->defaultSort('priority')
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Filtrer actifs'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Supprimer'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfoArmies::route('/'),
            'create' => Pages\CreateInfoArmy::route('/create'),
            'edit' => Pages\EditInfoArmy::route('/{record}/edit'),
        ];
    }
}
