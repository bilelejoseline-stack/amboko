<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Militaire;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\{TextInput, Select, DatePicker, Toggle, FileUpload};
use Filament\Tables\Columns\{TextColumn, BadgeColumn, IconColumn, ImageColumn};
use Filament\Tables\Filters\{SelectFilter, TernaryFilter};
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Utilisateurs';
    protected static ?string $pluralModelLabel = 'Utilisateurs';
    protected static ?string $modelLabel = 'Utilisateur';
    protected static ?string $navigationGroup = 'Gestion des utilisateurs';

    public static function form(Form $form): Form
    {
        $roles = ['user', 'agent', 'admin', 'super_admin', 'superviseur'];

        return $form
            ->schema([
              Select::make('name')
                  ->label('Nom affiché')
                  ->options(
                      \App\Models\Militaire::all()
                          ->mapWithKeys(function ($militaire) {
                              return [
                                  $militaire->nom . ' ' . $militaire->postnom . ' ' . $militaire->prenom
                                  => $militaire->nom . ' ' . $militaire->postnom . ' ' . $militaire->prenom
                              ];
                          })
                  )
                  ->searchable()
                  ->required(),


                TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Mot de passe')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context) => $context === 'create'),

                Select::make('role')
                    ->label('Rôle')
                    ->options(array_combine($roles, $roles))
                    ->required(),

                Toggle::make('is_active')
                    ->label('Compte actif')
                    ->default(true),

                TextInput::make('code')
                    ->label('Code d’accès')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('nom_complet')
                  ->label('Nom complet')
                  ->searchable(query: function (Builder $query, string $search): Builder {
                      return $query
                          ->where('name', 'like', "%{$search}%")
                          ->orWhereHas('militaire', function ($q) use ($search) {
                              $q->where('nom', 'like', "%{$search}%")
                                ->orWhere('postnom', 'like', "%{$search}%")
                                ->orWhere('prenom', 'like', "%{$search}%");
                          });
                  }),
                TextColumn::make('username')->label('Utilisateur')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                BadgeColumn::make('role')
                    ->colors([
                        'primary' => 'user',
                        'warning' => 'agent',
                        'success' => 'admin',
                        'danger' => 'super_admin',
                        'info' => 'superviseur',
                    ]),
                IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
                TextColumn::make('created_at')->label('Créé le')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'user' => 'Utilisateur',
                        'agent' => 'Agent',
                        'admin' => 'Admin',
                        'super_admin' => 'Super Admin',
                        'superviseur' => 'Superviseur',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Compte actif')
                    ->trueLabel('Actif')
                    ->falseLabel('Inactif')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
