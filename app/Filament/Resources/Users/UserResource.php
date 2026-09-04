<?php

namespace App\Filament\Resources\Users;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class UserResource extends Resource {
    protected static ?string $model = User::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';

    public static function canViewAny(): bool {
        return auth()->user()?->role === 'admin';
    }

    public static function canCreate(): bool {
        return auth()->user()?->role === 'admin';
    }

    public static function canEdit($record): bool {
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete($record): bool {
        return auth()->user()?->role === 'admin';
    }

    public static function form(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make('Users')
                    ->schema([ 
                        Grid::make(7)
                            ->schema([ 
                                Select::make('role')->label('Role')
                                    ->options([
                                        'user' => 'User',
                                        'author' => 'Author',
                                        'admin' => 'Admin',
                                    ])->default('user')->required()->columnSpan(1),
                                    
                                TextInput::make('name')->label('Name')->required()->maxLength(50)->columnSpan(2),
                                TextInput::make('email')->label('Email')->email()->required()->unique(ignoreRecord: true)->maxLength(50)->columnSpan(2),                                
                                TextInput::make('password')->label('Password')->password()->revealable()->required(fn (string $operation): bool => $operation === 'create')
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))->columnSpan(2),
                                ]),
                        ])->columnSpanFull(),
                ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('role')->label('Role')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Users\Pages\ListUsers::route('/'),
            'create' => \App\Filament\Resources\Users\Pages\CreateUser::route('/create'),
            'edit' => \App\Filament\Resources\Users\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}