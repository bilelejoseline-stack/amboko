<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComdtResource\Pages;
use App\Filament\Resources\ComdtResource\RelationManagers;
use App\Models\Comdt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;


class ComdtResource extends Resource
{
    protected static ?string $model = Comdt::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Gestion Commandants Suprêmes';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Informations Générales')->schema([
                TextInput::make('titre')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('slug', Str::slug($state))
                        ),

                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('commandants'),

                TextInput::make('debut_annee')
                    ->label('Début Année')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(now()->year)
                    ->required(),

                TextInput::make('fin_annee')
                    ->label('Fin Année')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(now()->year)
                    ->nullable(),

                Textarea::make('citation')
                    ->label('Citation')
                    ->rows(2)
                    ->maxLength(500)
                    ->nullable(),
            ]),

            Section::make('Contenu')->schema([
                Repeater::make('contenus')
                    ->label('Blocs de contenu')
                    ->schema([
                        TextInput::make('sous_titre')
                            ->label('Sous-titre')
                            ->required(),

                        Textarea::make('content')
                            ->label('Contenu')
                            ->rows(4)
                            ->required(),
                    ])
                    ->defaultItems(1)
                    ->createItemButtonLabel('Ajouter un bloc')
                    ->collapsible(),
            ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->rounded()
                    ->circular(),

                Tables\Columns\TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('debut_annee')
                    ->label('Début'),

                Tables\Columns\TextColumn::make('fin_annee')
                    ->label('Fin')
                    ->default('Présent'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListComdts::route('/'),
            'create' => Pages\CreateComdt::route('/create'),
            'edit' => Pages\EditComdt::route('/{record}/edit'),
        ];
    }
}
