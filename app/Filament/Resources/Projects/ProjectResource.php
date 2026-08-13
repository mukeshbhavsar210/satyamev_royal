<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Navigation\NavigationGroup;
use UnitEnum;

class ProjectResource extends Resource {
    protected static string|UnitEnum|null $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?int $navigationSort = 2;

    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('project_name')->label('Project Name')->required()->maxLength(255),
                Select::make('category')->label('Category')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                    ])->required(),

                TextInput::make('location')->label('Location')->maxLength(255),
                FileUpload::make('image')->label('Project Image')->image()->disk('public')
                    ->directory('projects')
                    ->visibility('public')
                    ->required(),

                Textarea::make('description')->label('Project Details')->rows(8)->columnSpanFull(),
                FileUpload::make('gallery')->label('Image Gallery')->image()->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->disk('public')
                    ->directory('projects/gallery')
                    ->visibility('public')
                    ->columnSpanFull(),
            ]);
    }

    public static function form(Schema $schema): Schema {
         return $schema
            ->components([
                TextInput::make('project_name')->label('Project Name')->required()->maxLength(255)->columnSpan(2),
                Select::make('category')->label('Category')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                    ])->required()->columnSpan(1),

                TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(2),                
                Toggle::make('status')->label('Active')->default(true)->columnSpan(1),

                Textarea::make('description')->label('Project Details')->rows(3)->columnSpan(2),
                FileUpload::make('image')->label('Project Image')->image()->disk('public')
                    ->directory('projects')->visibility('public')->required()->columnSpan(1),
                
                FileUpload::make('gallery')->label('Image Gallery')->image()->multiple()
                    ->reorderable()->appendFiles()->disk('public')->directory('projects/gallery')
                    ->visibility('public')->columnSpan(2),                
                
            ])->columns(3);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('project_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->searchable()->sortable(),                
                Tables\Columns\IconColumn::make('status')->boolean(),                
            ])            
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
