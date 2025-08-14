<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput, Select, DatePicker, Textarea, FileUpload, Wizard, Wizard\Step};
use Filament\Tables\Columns\{TextColumn};
use Filament\Tables\Actions\Action;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Documents';
    protected static ?string $pluralModelLabel = 'Documents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Informations de base')
                        ->schema([
                            TextInput::make('reference')
                                ->required()
                                ->maxLength(50),

                            TextInput::make('slug')
                                ->label('Slug (automatique)')
                                ->disabled()
                                ->dehydrated(false)
                                ->hint('Généré automatiquement à la sauvegarde'),

                            TextInput::make('objet')
                                ->required(),

                            Textarea::make('description')
                                ->rows(3),

                            Select::make('type_document')
                                ->required()
                                ->options([
                                    'Lettre' => 'Lettre',
                                    'Rapport' => 'Rapport',
                                    'Note' => 'Note',
                                    'Décision' => 'Décision',
                                    'Ordre de Mission' => 'Ordre de Mission',
                                    'Instruction' => 'Instruction',
                                    'Message' => 'Message',
                                    'Mémo' => 'Mémo',
                                    'Télégramme' => 'Télégramme',
                                    'Ordonnance' => 'Ordonnance',
                                    'Sitrep' => 'Sitrep',
                                    'Fiche' => 'Fiche',
                                    'Requête' => 'Requête',
                                    'Autre' => 'Autre',
                                ]),

                            DatePicker::make('date_document')
                                ->required(),
                        ]),

                    Step::make('Suivi et destinataires')
                        ->schema([
                            DatePicker::make('date_reception'),
                            DatePicker::make('date_sortie'),
                            TextInput::make('provenance'),
                            TextInput::make('destinataire'),

                            Select::make('statut')
                                ->options([
                                    'Enregistré' => 'Enregistré',
                                    'En attente' => 'En attente',
                                    'Traité' => 'Traité',
                                    'Classé' => 'Classé',
                                ])
                                ->default('Enregistré'),

                            Select::make('priorite')
                                ->options([
                                    'Basse' => 'Basse',
                                    'Normale' => 'Normale',
                                    'Haute' => 'Haute',
                                    'Urgente' => 'Urgente',
                                ])
                                ->default('Normale'),
                        ]),

                    Step::make('Mentions et fichiers')
                        ->schema([
                            Textarea::make('mention')->label('Mentions'),
                            Textarea::make('observations'),

                            FileUpload::make('fichier')
                                ->label('Pièce jointe')
                                ->directory('documents')
                                ->preserveFilenames()
                                ->downloadable()
                                ->previewable(),

                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->label('Utilisateur concerné'),
                        ]),
                ])->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')->sortable()->searchable(),
                TextColumn::make('slug')->copyable()->wrap()->label('Slug')->searchable(),
                TextColumn::make('objet')->limit(50)->searchable(),
                TextColumn::make('type_document'),

                TextColumn::make('statut')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Enregistré' => 'gray',
                        'En attente' => 'warning',
                        'Traité' => 'success',
                        'Classé' => 'info',
                    }),

                TextColumn::make('priorite')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Basse' => 'gray',
                        'Normale' => 'primary',
                        'Haute' => 'warning',
                        'Urgente' => 'danger',
                    }),

                TextColumn::make('date_document')->date('d/m/Y'),
                TextColumn::make('user.name')->label('Utilisateur'),
                TextColumn::make('created_at')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('statut')->options([
                    'Enregistré' => 'Enregistré',
                    'En attente' => 'En attente',
                    'Traité' => 'Traité',
                    'Classé' => 'Classé',
                ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Action::make('ouvrir')
                    ->label('Ouvrir')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->tooltip('Ouvrir dans Livewire via slug')
                    ->url(fn (Document $record) => route('documents.create', $record->slug))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
