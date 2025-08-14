<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandantResource\Pages;
use App\Filament\Resources\CommandantResource\RelationManagers;
use App\Models\Commandant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, RichEditor, FileUpload};
use Filament\Tables\Columns\{TextColumn, ImageColumn, BooleanColumn};
use Filament\Forms\Set;
use Illuminate\Support\Str;


class CommandantResource extends Resource
{
    protected static ?string $model = Commandant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Gestion Commandants Suprêmes';
    protected static ?string $label = 'Commandant';
    protected static ?string $pluralLabel = 'Commandants';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
      return $form
      ->schema([
          Forms\Components\TextInput::make('nom')
              ->required()
              ->maxLength(255),

              TextInput::make('titre')
                  ->label('Titre')
                  ->required()
                  ->live(onBlur: true)
                  ->afterStateUpdated(function (Set $set, $state) {
                      $set('slug', Str::slug($state));
                  }),

              TextInput::make('slug')
                  ->label('Slug')
                  ->disabled()
                  ->dehydrated()
                  ->required()
                  ->unique(ignoreRecord: true),

          Forms\Components\FileUpload::make('image')
              ->image()
              ->disk('public')
              ->visibility('public')
              ->directory('commandants')
              ->imageEditor()
              ->label('Photo officielle')
              ->imageEditor()
              ->imageEditorAspectRatios([
                  '16:9',
                  '4:3',
                  '1:1',
              ]),

              RichEditor::make('description')
                  ->label('Description')
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



          Forms\Components\Grid::make(2)->schema([
              Forms\Components\TextInput::make('debut')
                  ->numeric()
                  ->minValue(1900)
                  ->maxValue(2100)
                  ->label('Année de début'),

              Forms\Components\TextInput::make('fin')
                  ->numeric()
                  ->minValue(1900)
                  ->maxValue(2100)
                  ->label('Année de fin'),
          ]),

          Forms\Components\TextInput::make('ordre')
              ->numeric()
              ->label('Ordre d\'affichage'),

          Forms\Components\Toggle::make('actif')
              ->label('Afficher publiquement')
              ->default(true),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Photo')
                ->circular()
                ->size(40),

            Tables\Columns\TextColumn::make('nom')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('titre')->toggleable(),
            Tables\Columns\TextColumn::make('debut')->label('Début'),
            Tables\Columns\TextColumn::make('fin')->label('Fin'),
            Tables\Columns\TextColumn::make('slug')->toggleable(),
            Tables\Columns\IconColumn::make('actif')
                ->boolean()
                ->label('Actif'),
            Tables\Columns\TextColumn::make('ordre')->sortable(),
        ])
        ->defaultSort('ordre')
        ->filters([
            Tables\Filters\TernaryFilter::make('actif'),
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
            'index' => Pages\ListCommandants::route('/'),
            'create' => Pages\CreateCommandant::route('/create'),
            'edit' => Pages\EditCommandant::route('/{record}/edit'),
        ];
    }
}
