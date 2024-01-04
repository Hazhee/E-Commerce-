<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Setting';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create User')
                ->description('create a new user')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->translateLabel()
                        ->maxLength(255),

                    TextInput::make('username')
                        ->required()
                        ->translateLabel()
                        ->minLength(3)
                        ->unique(User::class, ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),

                    FileUpload::make('profile_photo_path')
                        ->image()
                        ->columnSpanFull()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth('180')
                        ->imageResizeTargetHeight('180')
                        ->label(__('Image'))
                        ->directory('upload/user_images')
                        ,

                    TextInput::make('phone')
                        ->translateLabel()
                        ->required()
                        ->numeric(),

                    

                    TextInput::make('password')
                        ->password()
                        ->translateLabel()
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create'),

                    Select::make('status')
                        ->translateLabel()
                        ->hiddenOn('create')
                        ->native(false)
                        ->options([
                            'Inactive' => 'Inactive',
                            'Active' => 'Active',
                        ]),

                    TextInput::make('address')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),
                        
                    // FileUpload::make('profile_photo_path')
                    // ->label('Image')
                    // ->image()
                    // ->directory('images')
                    // ->columnSpanFull(),

                    Select::make('roles')
                        ->translateLabel()
                        ->relationship('roles','name')
                        ->preload()
                        ->multiple(),
                
                ])->columns(3),
               
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->searchable()
                ->translateLabel(),

                TextColumn::make('name')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),

                ImageColumn::make('profile_photo_path')
                     ->label(__('Image'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email')
                    ->sortable()
                    ->translateLabel()
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Active' => 'success',
                        'Inactive' => 'danger',

                    }),
                        


                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->translateLabel()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string{
        return __('User');
    }

    public static function getPluralModelLabel(): string{
        return __('Users');
    }
}
