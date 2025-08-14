<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SanteMilitaireResource\Pages;
use App\Models\SanteMilitaire;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use FilamentTiptapEditor\TiptapEditor;

class SanteMilitaireResource extends Resource
{
    protected static ?string $model = SanteMilitaire::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Santé Militaire';
    protected static ?string $pluralModelLabel = 'Santé Militaire';
    protected static ?string $slug = 'sante-militaire';
    protected static ?int $navigationSort = 2;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, callable $set) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                TextInput::make('sous_titre')
                    ->label('Sous-titre (unique)')
                    ->nullable(),

                RichEditor::make('description')
                    ->label('Description (unique)')
                    ->nullable()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike', 'bulletList', 'orderedList',
                        'link', 'undo', 'redo'
                    ]),

                Repeater::make('contenus')
                    ->label('Contenus multiples')
                    ->schema([
                        TextInput::make('sous_titre')
                            ->label('Sous-titre')
                            ->nullable(),
                            TiptapEditor::make('description')
                                ->label('Description')
                                ->nullable()
                                ->columnSpanFull()
                                ->profile('default') // Utilisez un profil Tiptap (vous pouvez le customiser)
                                //->fileAttachmentsDisk('public')
                                //->fileAttachmentsDirectory('sante/rich-editor')
                                //->fileAttachmentsVisibility('public')
                                //->helperText('Ajoutez une image miniature à gauche, le texte s’adaptera.')
                                //->maxContentWidth('prose')
                                //->maxHeight(500)
                                , // Limite la hauteur dans l'admin

                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->reorderable()
                    ->addActionLabel('Ajouter un contenu'),

                FileUpload::make('image')
                    ->image()
                    ->directory('sante')
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                    ->nullable()
                    ->preserveFilenames()
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file && \Storage::disk('public')->exists($file)) {
                            \Storage::disk('public')->delete($file);
                        }
                    }),

                Toggle::make('active')
                    ->label('Visible ?')
                    ->default(true),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Image')->circular(),
                TextColumn::make('titre')->searchable()->limit(30),
                TextColumn::make('sous_titre')->label('Sous-titre')->limit(40),
                IconColumn::make('active')->boolean(),
                TextColumn::make('created_at')->label('Créé le')->date(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSanteMilitaires::route('/'),
            'create' => Pages\CreateSanteMilitaire::route('/create'),
            'edit' => Pages\EditSanteMilitaire::route('/{record}/edit'),
        ];
    }
}
