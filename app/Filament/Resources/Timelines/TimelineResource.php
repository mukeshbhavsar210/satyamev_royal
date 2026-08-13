<?php

namespace App\Filament\Resources\Timelines;

use App\Filament\Resources\Timelines\Pages\CreateTimeline;
use App\Filament\Resources\Timelines\Pages\EditTimeline;
use App\Filament\Resources\Timelines\Pages\ListTimelines;
use App\Filament\Resources\Timelines\Schemas\TimelineForm;
use App\Filament\Resources\Timelines\Tables\TimelinesTable;
use App\Models\Timeline;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Navigation\NavigationGroup;
use UnitEnum;

class TimelineResource extends Resource {    
    protected static string|UnitEnum|null $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Timeline';
    protected static ?int $navigationSort = 3;

    protected static ?string $model = Timeline::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    public static function form(Schema $schema): Schema {
         return $schema
            ->components([
                TextInput::make('year')->label('Year')->required()->maxLength(20),
                TextInput::make('title')->label('Title')->required()->maxLength(255),
                FileUpload::make('image')
                    ->label('Timeline Image')
                    ->image()
                    ->disk('public')
                    ->directory('timeline')
                    ->visibility('public'),

                RichEditor::make('description')->label('Description')->columnSpanFull(),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('status')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('year')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('status')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => ListTimelines::route('/'),
            'create' => CreateTimeline::route('/create'),
            'edit' => EditTimeline::route('/{record}/edit'),
        ];
    }
}
