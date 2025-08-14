<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, RichEditor, FileUpload};
use Filament\Tables\Columns\{TextColumn, ImageColumn, BooleanColumn};


class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Équipe';
    protected static ?string $modelLabel = 'Membre de l’équipe';
    protected static ?string $navigationGroup = 'Gestion des utilisateurs';


    public static function form(Form $form): Form
    {
        return $form->schema([
            // 🧑 Nom
            TextInput::make('name')
                ->label('Nom')
                ->required()
                ->maxLength(255)
                ->columnSpan(6),

            // 🔗 Slug
            TextInput::make('slug')
                ->label('Identifiant (slug)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255)
                ->columnSpan(6),

            // 🧩 Rôle
            TextInput::make('role')
                ->label('Rôle')
                ->required()
                ->maxLength(255)
                ->columnSpan(6),

            // 🖼️ Avatar
            FileUpload::make('avatar')
                ->label('Avatar')
                ->disk('public')              // stockage dans storage/app/public
                ->directory('teams')          // sous dossier teams
                ->visibility('public')
                ->image()
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '16:9',
                    '4:3',
                    '1:1',
                ])
                ->nullable()
                ->columnSpan(6),

            // 📝 Biographie
            RichEditor::make('bio')
                ->label('Biographie')
                ->fileAttachmentsDisk('public') // tu peux adapter
                ->fileAttachmentsDirectory('attachments')
                ->fileAttachmentsVisibility('private')
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->columnSpan('full'),

            // ✅ Actif
            Toggle::make('active')
                ->label('Actif')
                ->default(true)
                ->columnSpan(6),
        ])->columns(12); // 👈 C’est cette ligne qui divise l’espace en 12
    }


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('avatar')
                ->label('Avatar')
                ->url(fn ($record) => asset($record->avatar)) // accès via public/teams
                ->circular(),

            TextColumn::make('name')
                ->searchable()
                ->sortable(),

            TextColumn::make('role')
                ->searchable()
                ->sortable(),

            BooleanColumn::make('active')
                ->label('Actif')
        ])
        ->defaultSort('name')
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }


        public static function canAccess(): bool
        {
            return auth()->user()?->hasRole('super_admin');
        }


}
