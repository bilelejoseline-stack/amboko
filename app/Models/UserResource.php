<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\{TextInput, Select, DatePicker, Toggle, FileUpload};
use Filament\Tables\Columns\{TextColumn, BadgeColumn, IconColumn, ImageColumn};

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Gestion des utilisateurs';
    protected static ?string $label = 'Utilisateur';
    protected static ?string $pluralLabel = 'Utilisateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('photo')
                    ->avatar()
                    ->image()
                    ->directory('avatars')
                    ->label('Photo de profil'),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('username')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('gender')
                    ->options([
                        'male' => 'Homme',
                        'female' => 'Femme',
                    ])
                    ->label('Genre'),

                TextInput::make('phone')
                    ->tel(),

                TextInput::make('matricule')
                    ->label('Matricule'),

                TextInput::make('grade')
                    ->label('Grade'),

                DatePicker::make('birthdate')
                    ->label('Date de naissance'),

                Toggle::make('is_active')
                    ->label('Actif'),

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->label('Rôles')
                    ->visible(fn () => auth()->user()?->hasRole('super-admin')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->circular(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('username'),
                TextColumn::make('matricule'),
                TextColumn::make('grade'),
                BadgeColumn::make('roles.name')->label('Rôle(s)'),
                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-x-circle'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => self::canEdit($record)),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()?->hasRole('super-admin')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => auth()->user()?->hasRole('super-admin')),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin');
    }

}
