<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MilitaireResource\Pages;
use App\Filament\Resources\MilitaireResource\RelationManagers;
use App\Models\Militaire;
use App\Models\Grade;
use App\Models\Province;
use App\Models\District;
use App\Models\Territoire;
use App\Models\Collectivite;
use App\Models\Localite;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MilitaireResource extends Resource
{
    protected static ?string $model = Militaire::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Gestion Militaire';
    protected static ?string $label = 'Militaire';
    protected static ?string $pluralLabel = 'Militaires';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('matricule')
                    ->disabled()
                    ->dehydrated(false)
                    ->label('Matricule automatique'),

                TextInput::make('nom')->required()->maxLength(255),
                TextInput::make('postnom')->required()->maxLength(255),
                TextInput::make('prenom')->required()->maxLength(255),

                Select::make('grade_id')
                    ->relationship('grade', 'nom_grade')
                    ->searchable()
                    ->required(),

                TextInput::make('fonction')->maxLength(255),
                TextInput::make('unite')->maxLength(255),

                DatePicker::make('date_incorporation')->required(),
                TextInput::make('lieu_incorporation')->maxLength(255),

                DatePicker::make('date_naissance')->required(),
                TextInput::make('lieu_naissance')->maxLength(255),

                Select::make('sexe')
                    ->options(['M' => 'Masculin', 'F' => 'Féminin'])
                    ->required(),

                Select::make('etat_civil')
                    ->options(['Célibataire' => 'Célibataire', 'Marié(e)' => 'Marié(e)', 'Veuf(ve)' => 'Veuf(ve)'])
                    ->required(),

                TextInput::make('epouse')->label('Nom de l’épouse')->maxLength(255),
                TextInput::make('papa')->label('Nom du père')->maxLength(255),
                TextInput::make('maman')->label('Nom de la mère')->maxLength(255),

                // 📍 Liens géographiques (via select relation)
                Select::make('province_id')
                    ->relationship('province', 'nom')
                    ->searchable()
                    ->required(),

                Select::make('district_id')
                    ->relationship('district', 'nom')
                    ->searchable()
                    ->required(),

                Select::make('territoire_id')
                    ->relationship('territoire', 'nom')
                    ->searchable()
                    ->required(),

                Select::make('collectivite_id')
                    ->relationship('collectivite', 'nom')
                    ->searchable()
                    ->required(),

                Select::make('localite_id')
                    ->relationship('localite', 'nom')
                    ->searchable()
                    ->required(),

                Select::make('statut')
                    ->options(['Actif' => 'Actif', 'Réserve' => 'Réserve', 'Retraité' => 'Retraité'])
                    ->required(),

                TextInput::make('code')
                    ->maxLength(8)
                    ->disabled()
                    ->dehydrated(false)
                    ->label('Code automatique'),

                TextInput::make('adresse')->maxLength(255),
                TextInput::make('telephone')->tel()->maxLength(20),

                FileUpload::make('avatar')
                    ->label('Photo (avatar)')
                    ->image()
                    ->directory('militaires/images')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->nullable(),


                // 🧒 Enfants

                Repeater::make('enfants')
                    ->relationship()
                    ->schema([
                        Grid::make(2) // Grille interne pour les champs de chaque enfant
                            ->schema([
                                TextInput::make('nom')->required(),
                                TextInput::make('postnom')->required(),
                                TextInput::make('prenom')->required(),
                                DatePicker::make('date_naissance')->required(),
                                TextInput::make('lieu_naissance')->required(),
                                Select::make('sexe')->options([
                                    'M' => 'Masculin',
                                    'F' => 'Féminin',
                                ])

                                ->required(),
                            ]),
                    ])
                    ->minItems(0)
                    ->collapsible()
                    ->label('Enfants')
                    ->createItemButtonLabel('Ajouter un enfant')
                    ->extraAttributes(['class' => 'enfants-grid']),  // Ajoute classe pour la grille externe

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matricule')->searchable()->sortable(),
                TextColumn::make('nom')->searchable(),
                TextColumn::make('postnom')->searchable(),
                TextColumn::make('prenom')->searchable(),
                TextColumn::make('grade.nom_grade')->label('Grade')->sortable(),
                TextColumn::make('statut')->sortable(),
            ])
            ->filters([
                // Ajoutez des filtres ici
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
              RelationManagers\EnfantsRelationManager::class,
              RelationManagers\PaiesRelationManager::class,
              RelationManagers\PromotionsRelationManager::class,
              RelationManagers\AffectationsRelationManager::class,
              RelationManagers\EtudesCivilesRelationManager::class,
              RelationManagers\EtudesMilitairesRelationManager::class,
              RelationManagers\HistoriquesRelationManager::class,
              RelationManagers\SpecialitesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMilitaires::route('/'),
            'create' => Pages\CreateMilitaire::route('/create'),
            'edit' => Pages\EditMilitaire::route('/{record}/edit'),
        ];
    }
}
