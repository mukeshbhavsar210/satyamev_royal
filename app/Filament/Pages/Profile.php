<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class Profile extends Page {
    protected string $view = 'filament.pages.my-profile';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?string $title = 'Profile';
    public ?array $data = [];

    public function mount(): void {
        $user = auth()->user();

        $this->data = [
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    public function form(Schema $schema): Schema {
        return $schema
            ->components([
                Section::make('Admin Details')
                    ->schema([
                        TextInput::make('name')->label('Name')->required(),
                        TextInput::make('email')->label('Email')->email()->disabled(),
                    ])
                    ->columns(2),

                Section::make('Change Password')
                    ->schema([
                        TextInput::make('current_password')->label('Current Password')->password()->revealable()->required(),
                        TextInput::make('password')->label('New Password')->password()->revealable()->minLength(8)->required(),
                        TextInput::make('password_confirmation')->label('Confirm New Password')->password()->revealable()->same('password')->required(),
                    ])
                    ->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void {
        $data = $this->data;
        $user = auth()->user();
        if (! Hash::check($data['current_password'], $user->password)) {
            $this->addError(
                'data.current_password',
                'Current password is incorrect.'
            );

            return;
        }

        $user->name = $data['name'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        Notification::make()->title('Profile updated successfully')->success()->send();

        $this->data = [
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}