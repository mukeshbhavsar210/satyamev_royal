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
use Filament\Forms\Components\Placeholder;
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
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Navigation\NavigationGroup;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use UnitEnum;

class SettingResource extends Resource{            
    protected static ?string $model = Setting::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;    

    public static function form(Schema $schema): Schema {    
        return $schema
        ->components([
                Tabs::make('Content')
                    ->tabs([
                        Tab::make('Details')
                            ->schema([
                                Section::make('')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('company_name')->label('Company Name')->columnSpan(1),                                                
                                                TextInput::make('business_line')->label('Business Line')->columnSpan(1),
                                                Textarea::make('address')->label('Address')->columnSpan(1),
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('mobile')->label('Mobile')->tel()->columnSpan(1),
                                                        TextInput::make('phone')->label('Phone')->tel()->columnSpan(1),
                                                ]),
                                    ]), 
                                ])->contained(false),
                            ]),

                        Tab::make('Social accounts')
                            ->schema([
                                Section::make('')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('facebook')->label('Facebook')->url(),
                                                TextInput::make('instagram')->label('Instagram')->url(),
                                                TextInput::make('youtube')->label('YouTube')->url(),
                                                TextInput::make('linkedin')->label('LinkedIn')->url(),        
                                            ]),                                        
                                    ])->contained(false),
                            ]),

                        Tab::make('Banners')
                            ->schema([
                                Section::make('')                                
                                    ->schema([                                        
                                        Section::make('Hero')
                                            ->schema([                                                       
                                                Grid::make(7)
                                                    ->schema([                                                        
                                                        FileUpload::make('hero_upload')->hiddenLabel()->image()->disk('public')->directory('settings/hero')
                                                            ->afterStateUpdated(function ($state) {
                                                                if (empty($state)) {
                                                                    return;
                                                                }

                                                                // FileUpload may return an array
                                                                $path = is_array($state)
                                                                    ? reset($state)
                                                                    : $state;

                                                                if (!$path) {
                                                                    return;
                                                                }

                                                                $sourcePath = Storage::disk('public')->path($path);

                                                                if (!file_exists($sourcePath)) {
                                                                    return;
                                                                }

                                                                $manager = new ImageManager(
                                                                    new Driver()
                                                                );
                                                                $sizes = [500,800,1080,1600,1920,];
                                                                $hero = [];
                                                                foreach ($sizes as $width) {
                                                                    $filename = "hero_{$width}.webp";
                                                                    $relativePath = "settings/hero/{$filename}";
                                                                    $fullPath = Storage::disk('public')->path($relativePath);
                                                                    $image = $manager->read($sourcePath);
                                                                    // Don't enlarge smaller images
                                                                    if ($image->width() > $width) {
                                                                        $image->scale(width: $width);
                                                                    }
                                                                    $image->toWebp(85)->save($fullPath);
                                                                    $hero[$width] = $relativePath;
                                                                }
                                                                // Update settings table
                                                                $setting = Setting::first();
                                                                if ($setting) {
                                                                    $setting->update([
                                                                        'hero' => $hero,
                                                                    ]);
                                                                }
                                                                // Delete uploaded original
                                                                Storage::disk('public')->delete($path);
                                                            })
                                                            ->columnSpan(6),

                                                            Placeholder::make('hero_preview')->hiddenLabel()                                                                    
                                                                ->content(function () {
                                                                    $hero = \App\Models\Setting::first()?->hero;

                                                                    if (empty($hero['1920'])) {
                                                                        return 'No hero image uploaded.';
                                                                    }

                                                                    return new \Illuminate\Support\HtmlString(
                                                                        '<img src="' . Storage::url($hero['1920']) . '" style="width:100%; height:auto; border-radius:8px;" alt="Hero Image">'
                                                                    );
                                                                })
                                                                ->columnSpan(1),
                                                    ]),
                                                ])
                                            ->collapsible()
                                            ->collapsed(),                                             

                                        Section::make('Gallery')
                                            ->schema([
                                                Grid::make(7)
                                                    ->schema([
                                                        FileUpload::make('gallery_upload')->hiddenLabel()->label('Gallery Image')->image()->disk('public')->directory('settings/gallery')
                                                            ->afterStateUpdated(function ($state) {
                                                                if (empty($state)) {
                                                                    return;
                                                                }

                                                                // FileUpload may return an array
                                                                $path = is_array($state)
                                                                    ? reset($state)
                                                                    : $state;

                                                                if (!$path) {
                                                                    return;
                                                                }

                                                                $sourcePath = Storage::disk('public')->path($path);

                                                                if (!file_exists($sourcePath)) {
                                                                    return;
                                                                }

                                                                $manager = new ImageManager(
                                                                    new Driver()
                                                                );

                                                                $sizes = [500,800,1080,1600,1920,];
                                                                $gallery = [];

                                                                foreach ($sizes as $width) {
                                                                    $filename = "gallery_{$width}.webp";
                                                                    $relativePath = "settings/gallery/{$filename}";
                                                                    $fullPath = Storage::disk('public')->path($relativePath);
                                                                    $image = $manager->read($sourcePath);
                                                                    // Don't enlarge smaller images
                                                                    if ($image->width() > $width) {
                                                                        $image->scale(width: $width);
                                                                    }
                                                                    $image->toWebp(85)->save($fullPath);
                                                                    $gallery[$width] = $relativePath;
                                                                }

                                                                // Update settings table
                                                                $setting = Setting::first();

                                                                if ($setting) {
                                                                    $setting->update([
                                                                        'gallery' => $gallery,
                                                                    ]);
                                                                }

                                                                // Delete uploaded original
                                                                Storage::disk('public')->delete($path);
                                                            })
                                                            ->columnSpan(6), 

                                                            Placeholder::make('gallery_preview')->hiddenLabel()->label('Gallery Image')
                                                                ->content(function () {
                                                                    $gallery = \App\Models\Setting::first()?->gallery;
                                                                    if (empty($gallery['1920'])) {
                                                                        return 'No Gallery image uploaded.';
                                                                    }
                                                                    return new \Illuminate\Support\HtmlString(
                                                                        '<img src="' . Storage::url($gallery['1920']) . '" style="width:100%; max-width:800px; height:auto; border-radius:8px;" alt="Gallery Image">'
                                                                    );
                                                                })
                                                                ->columnSpan(1),
                                                        ]),
                                                ])
                                            ->collapsible()
                                            ->collapsed(),

                                        Section::make('Why')
                                            ->schema([
                                                Grid::make(7)
                                                    ->schema([
                                                    FileUpload::make('why_upload')->hiddenLabel()->label('')->image()->disk('public')->directory('settings/why')
                                                        ->afterStateUpdated(function ($state) {
                                                            if (empty($state)) {
                                                                return;
                                                            }
                                                            // FileUpload may return an array
                                                            $path = is_array($state)
                                                                ? reset($state)
                                                                : $state;

                                                            if (!$path) {
                                                                return;
                                                            }
                                                            $sourcePath = Storage::disk('public')->path($path);
                                                            if (!file_exists($sourcePath)) {
                                                                return;
                                                            }
                                                            $manager = new ImageManager(
                                                                new Driver()
                                                            );
                                                            $sizes = [500,800,1080,1600,1920,];
                                                            $why = [];
                                                            foreach ($sizes as $width) {
                                                                $filename = "why{$width}.webp";
                                                                $relativePath = "settings/why/{$filename}";
                                                                $fullPath = Storage::disk('public')->path($relativePath);
                                                                $image = $manager->read($sourcePath);
                                                                // Don't enlarge smaller images
                                                                if ($image->width() > $width) {
                                                                    $image->scale(width: $width);
                                                                }
                                                                $image->toWebp(85)->save($fullPath);
                                                                $why[$width] = $relativePath;
                                                            }

                                                            // Update settings table
                                                            $setting = Setting::first();

                                                            if ($setting) {
                                                                $setting->update([
                                                                    'why' => $why,
                                                                ]);
                                                            }

                                                            // Delete uploaded original
                                                            Storage::disk('public')->delete($path);
                                                        })
                                                        ->columnSpan(6),        

                                                        Placeholder::make('why_preview')->hiddenLabel()->label('Why Image')
                                                            ->content(function () {
                                                                $why = \App\Models\Setting::first()?->why;
                                                                if (empty($why['1920'])) {
                                                                    return 'No Why image uploaded.';
                                                                }
                                                                return new \Illuminate\Support\HtmlString(
                                                                    '<img src="' . Storage::url($why['1920']) . '" style="width:100%; max-width:800px; height:auto; border-radius:8px;" alt="Gallery Image">'
                                                                );
                                                            })
                                                            ->columnSpan(1),
                                                    ]),                                                        
                                                ])
                                            ->collapsible()
                                            ->collapsed(),                                        
                                        ])->contained(false),
                                ]),

                        Tab::make('Theme')
                            ->schema([
                                Section::make('')
                                    ->schema([
                                         Grid::make(2)
                                            ->schema([
                                                ViewField::make('theme_template')->label('Theme')->view('filament.pages.theme-selector')->columnSpan(1),
                                                ToggleButtons::make('preloader')->label('Preloader')
                                                    ->options([
                                                        1 => 'Yes',
                                                        0 => 'No',
                                                    ])
                                                    ->inline()->default(0)->required()->columnSpan(1),
                                            ]),
                                    ])->contained(false),
                            ]),
                    ])
                    ->columnSpanFull(),                                       
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
