<?php

namespace App\Filament\Resources\Galleries;

use App\Filament\Resources\Galleries\Pages\CreateGallery;
use App\Filament\Resources\Galleries\Pages\EditGallery;
use App\Filament\Resources\Galleries\Pages\ListGalleries;
use App\Filament\Resources\Galleries\Schemas\GalleryForm;
use App\Filament\Resources\Galleries\Tables\GalleriesTable;
use App\Models\Gallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Navigation\NavigationGroup;
use UnitEnum;

class GalleryResource extends Resource {
    protected static ?string $model = Gallery::class;
    protected static string|UnitEnum|null $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Apartments';
    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('title')->maxLength(255),
            FileUpload::make('image')
                ->label('Gallery Image')
                ->image()
                ->disk('public')
                ->directory('gallery')
                ->visibility('public')
                ->required()
                ->getUploadedFileNameForStorageUsing(function ($file, $get) {
                    $title = $get('title');                    
                    $date = now()->format('Y-m-d');
                    $extension = $file->getClientOriginalExtension();
                    return $title . '-' . $date . '.' . $extension;
                }),

            Textarea::make('description'),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0),

            Toggle::make('status')
                ->default(true),

        ]);
}

    public static function table(Table $table): Table
{
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

            ])
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->defaultSort('sort_order');
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
            'index' => ListGalleries::route('/'),
            'create' => CreateGallery::route('/create'),
            'edit' => EditGallery::route('/{record}/edit'),
        ];
    }
}
