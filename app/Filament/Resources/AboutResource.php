<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use FilamentTiptapEditor\TiptapEditor;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    // ✅ Icône personnalisée (ex : heroicon-s-shield-check ou icône SVG inline)
    protected static ?string $navigationIcon = 'heroicon-s-shield-check'; // ou path svg personnalisé

    protected static ?string $navigationLabel = 'À propos FARDC';
    protected static ?string $navigationGroup = 'Pages Publiques';
    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->disabled()
                    ->hidden()
                    ->dehydrated(),

                // ✅ Repeatable sous-titres
                Forms\Components\Repeater::make('subtitles')
                    ->label('Sous-titres')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Sous-titre')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->default([])
                    ->collapsible()
                    ->addActionLabel('Ajouter sous-titre'),

                // ✅ Repeatable descriptions avec Tiptap
                Forms\Components\Repeater::make('descriptions')
                    ->label('Descriptions')
                    ->schema([
                        TiptapEditor::make('value')
                            ->label('Description')
                            ->required()
                            ->profile('default'),
                    ])
                    ->default([])
                    ->collapsible()
                    ->addActionLabel('Ajouter description'),

                Forms\Components\FileUpload::make('image')
                    ->label('Image principale')
                    ->directory('abouts/images')
                    ->maxSize(3048) // en Ko, ici 2 Mo
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'application/pdf', 'video/mp4'])
                    ->imageEditor()
                    ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                    ->nullable(),

                Forms\Components\FileUpload::make('video')
                    ->label('Vidéo locale (MP4, WebM)')
                    ->directory('abouts/videos')
                    ->acceptedFileTypes(['video/mp4', 'video/webm'])
                    ->maxSize(20480)
                    ->preserveFilenames(),

                Forms\Components\Toggle::make('active')
                    ->label('Actif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->color('gray')
                    ->limit(30),

                Tables\Columns\ToggleColumn::make('active')
                    ->label('Actif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Statut')
                    ->trueLabel('Actif')
                    ->falseLabel('Inactif')
                    ->default(true),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
