<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages\CreateSetting;
use App\Filament\Resources\Settings\Pages\EditSetting;
use App\Filament\Resources\Settings\Pages\ListSettings;
use App\Filament\Resources\Settings\Schemas\SettingForm;
use App\Filament\Resources\Settings\Tables\SettingsTable;
use Filament\Forms\Components\ViewField;
use App\Models\Setting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\Settings\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Tables;

class SettingResource extends Resource{    
    protected static ?string $model = Setting::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')->label('Company Name')->required()->maxLength(255)->columnSpan(1),
                TextInput::make('business_line')->label('Business Line')->required()->maxLength(255)->columnSpan(3),
                Textarea::make('address')->label('Address')->rows(4)->columnSpanFull(),
                TextInput::make('phone')->label('Phone')->tel()->maxLength(50)->columnSpan(1),
                TextInput::make('mobile')->label('Mobile')->tel()->maxLength(50)->columnSpan(1),
                TextInput::make('punch_line')->label('Punch Line')->maxLength(100)->columnSpan(2),
                TextInput::make('since')->label('Since')->maxLength(10)->columnSpan(1),
                TextInput::make('facebook_url')->label('Facebook URL')->url()->placeholder('https://facebook.com/')->columnSpan(2),
                TextInput::make('instagram_url')->label('Instagram URL')->url()->placeholder('https://instagram.com/')->columnSpan(2),
                ViewField::make('theme_template')->label('Theme')->view('filament.theme-selector')->columnSpan(2),
            ])->columns(4);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')->label('Company Name')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('mobile')->label('Mobile'),
                Tables\Columns\TextColumn::make('facebook_url')->label('Facebook')->limit(30),
                Tables\Columns\TextColumn::make('instagram_url')->label('Instagram')->limit(30),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
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
            'index' => EditSetting::route('/'),
        ];
    }
}
