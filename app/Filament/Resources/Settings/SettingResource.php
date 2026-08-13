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
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Navigation\NavigationGroup;
use UnitEnum;

class SettingResource extends Resource{            
    protected static ?string $model = Setting::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;    

    public static function form(Schema $schema): Schema {
        return $schema
            ->components([
                Grid::make(1)
                    ->columnSpanFull()
                    ->schema([                        
                        Section::make('General Settings main')
                                ->schema([
                                    TextInput::make('company_name')->label('Company Name'),
                                    TextInput::make('business_line')->label('Business Line'),
                                    Textarea::make('address')->label('Address'),
                                ])
                                ->collapsible(),                                                            
                        
                                Section::make('Contact Details')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('mobile')
                                                    ->label('Mobile')
                                                    ->tel(),

                                                TextInput::make('phone')
                                                    ->label('Phone')
                                                    ->tel(),
                                            ]),
                                    ])
                                    ->collapsible(),

                                Section::make('Social Accounts')     
                                    ->schema([
                                        Grid::make(2)                           
                                            ->schema([
                                                TextInput::make('facebook')->label('Facebook')->url(),
                                                TextInput::make('instagram')->label('Instagram')->url(),
                                                TextInput::make('youtube')->label('YouTube')->url(),
                                                TextInput::make('linkedin')->label('LinkedIn')->url(),
                                            ]),
                                        ])
                                    ->collapsible()
                                    ->collapsed(),    
                                    
                                Section::make('Theme')     
                                    ->schema([
                                        Grid::make(2)                           
                                            ->schema([
                                                ViewField::make('theme_template')->label('Theme')->view('filament.pages.theme-selector')->columnSpan(2),
                                            ]),
                                        ])
                                    ->collapsible()
                                    ->collapsed(), 
                    ]),
            ]);
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
