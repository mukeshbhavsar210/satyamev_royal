<?php

namespace App\Filament\Pages;

use App\Models\Apartment;
use App\Models\Project;
use App\Models\Timeline;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageHome extends Page implements HasForms, HasActions {
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Home';
    protected static ?string $title = 'Home';
    protected string $view = 'filament.pages.manage-home';   

    public function editProjectAction(): Action {
        return Action::make('editProject')
            ->modalHeading(fn (?Project $record) =>
                $record
                    ? 'Edit Project'
                    : 'Add Project'
            )
            ->modalWidth('4xl')
            ->schema([
                Grid::make(6)
                    ->schema([
                        TextInput::make('project_name')->label('Project Name ')->required()->maxLength(255)->columnSpan(3),
                        Select::make('category')->label('Category')
                            ->options([
                                'ongoing' => 'Ongoing',
                                'upcoming' => 'Upcoming',
                                'completed' => 'Completed',
                            ])->required()->columnSpan(2),

                        Select::make('status')->label('Status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Block',                                
                            ])->required()->columnSpan(1),
                        
                        Textarea::make('description')->label('Project Details')->rows(3)->columnSpan(3),
                        TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(3),
                        FileUpload::make('gallery')
                            ->label('Image Gallery')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->disk('public')
                            ->directory('projects/gallery')
                            ->visibility('public')
                            ->getUploadedFileNameForStorageUsing(
                                fn ($file, $get) =>
                                    \Illuminate\Support\Str::slug($get('project_name'))
                                    . '-'
                                    . now()->format('Y-m-d-His')
                                    . '-'
                                    . uniqid()
                                    . '.'
                                    . $file->getClientOriginalExtension()
                            )
                            ->columnSpan(3),

                        FileUpload::make('image')
                            ->label('Thumb')
                            ->image()
                            ->disk('public')
                            ->directory('projects/thumb')
                            ->visibility('public')
                            ->getUploadedFileNameForStorageUsing(
                                fn ($file, $get) =>
                                    \Illuminate\Support\Str::slug($get('project_name'))
                                    . '-'
                                    . now()->format('Y-m-d-His')
                                    . '.'
                                    . $file->getClientOriginalExtension()
                            )
                            ->columnSpan(3),
                    ]),                
            ])
            
            ->fillForm(function (?Project $record): array {
                if (! $record) {
                    return [
                        'status' => true,
                    ];
                }

                return [
                    'project_name' => $record->project_name,
                    'category'     => $record->category,
                    'location'     => $record->location,
                    'description'  => $record->description,
                    'image'       => $record->image,
                    'gallery'     => $record->gallery,
                    'status'      => $record->status,
                ];
            })

            ->action(function (array $data, ?Project $record) {
                if ($record) {
                    $record->update([
                        'project_name' => $data['project_name'],
                        'image' => $data['image'] ?? $record->image,
                    ]);
                } else {
                    $record = Project::create([
                        'project_name' => $data['project_name'],
                        'image' => $data['image'] ?? null,
                    ]);
                }

                // Save gallery images
                foreach ($data['gallery'] ?? [] as $index => $image) {

                    $record->images()->create([
                        'image' => $image,
                        'sort_order' => $index,
                    ]);
                }
            });
    }


    public function editTimelineAction(): Action {
        return Action::make('editTimeline')
            ->modalHeading(fn (?Timeline $record) =>
                $record ? 'Edit Timeline' : 'Add Timeline'
            )

            ->modalWidth('4xl')
            ->schema([
                Grid::make(4)
                    ->schema([
                        TextInput::make('title')->label('Title')->required()->maxLength(255)->columnSpan(2),
                        TextInput::make('year')->label('Year')->required()->maxLength(5)->columnSpan(1),
                        TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->columnSpan(1),
                        Textarea::make('description')->label('Description')->rows(3)->columnSpan(2),
                        FileUpload::make('image')->label('Timeline Image')->image()->disk('public')->directory('timeline')->visibility('public')->columnSpan(2),                        
                    ]),
            ])

            ->fillForm(function (?Timeline $record): array {

                if (! $record) {
                    return [
                        'status' => true,
                        'sort_order' => 0,
                    ];
                }

                return [
                    'year' => $record->year,
                    'title' => $record->title,
                    'description' => $record->description,
                    'image' => $record->image,
                    'sort_order' => $record->sort_order,
                    'status' => $record->status,
                ];
            })

            ->action(function (array $data, ?Timeline $record): void {

                if ($record) {
                    $record->update($data);
                } else {
                    Timeline::create($data);
                }

                $this->redirect(static::getUrl());
            });
    }


    public function editApartmentAction(): Action {
        return Action::make('editApartment')

            ->modalHeading(fn (?Apartment $record) =>
                $record ? 'Edit Apartment' : 'Add Apartment'
            )

            ->modalWidth('4xl')
            ->schema([
                Grid::make(6)
                    ->schema([
                        TextInput::make('name')->label('Apartment Name')->required()->maxLength(255)->columnSpan(3),
                        TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(2),
                        Select::make('status')->label('Status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Block',                                
                            ])->required()->columnSpan(1),

                        Textarea::make('description')->label('Description')->rows(3)->columnSpan(3),
                        FileUpload::make('image')->label('Apartment Image')->image()->disk('public')->directory('apartments')->visibility('public')->columnSpan(3),                        
                    ]),
            ])

            ->fillForm(function (?Apartment $record): array {

                if (! $record) {
                    return [
                        'status' => true,
                    ];
                }

                return [
                    'name' => $record->name,
                    'location' => $record->location,
                    'description' => $record->description,
                    'image' => $record->image,
                    'status' => $record->status,
                ];
            })

            ->action(function (array $data, ?Apartment $record): void {

                if ($record) {
                    $record->update($data);
                } else {
                    Apartment::create($data);
                }

                $this->redirect(static::getUrl());
            });
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PROJECT
    |--------------------------------------------------------------------------
    */

    public function deleteProjectAction(): Action
{
    return Action::make('deleteProject')
        ->requiresConfirmation()
        ->modalHeading('Delete Project')
        ->modalDescription('Are you sure you want to delete this project?')
        ->color('danger')

        ->action(function (array $data, array $arguments): void {

            $projectId = $arguments['record'] ?? null;

            if (! $projectId) {
                return;
            }

            $project = Project::find($projectId);

            if ($project) {
                $project->delete();
            }

            $this->redirect(static::getUrl());
        });
}


    /*
    |--------------------------------------------------------------------------
    | DELETE TIMELINE
    |--------------------------------------------------------------------------
    */

    public function deleteTimelineAction(): Action {
        return Action::make('deleteTimeline')
            ->requiresConfirmation()
            ->modalHeading('Delete Timeline')
            ->modalDescription('Are you sure you want to delete this timeline?')
            ->color('danger')

            ->action(function (array $data, array $arguments): void {

                $timelineId = $arguments['record'] ?? null;

                if (! $timelineId) {
                    return;
                }

                $timeline = Timeline::find($timelineId);

                if ($timeline) {
                    $timeline->delete();
                }

                $this->redirect(static::getUrl());
            });
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE APARTMENT
    |--------------------------------------------------------------------------
    */

    public function deleteApartmentAction(): Action
    {
        return Action::make('deleteApartment')
            ->requiresConfirmation()
            ->modalHeading('Delete Apartment')
            ->modalDescription('Are you sure you want to delete this apartment?')
            ->color('danger')
            ->action(function (Apartment $record): void {
                $record->delete();

                $this->redirect(static::getUrl());
            });
    }


    public function getCardSections(): array {
        return [
            [
                'heading' => 'Projects',
                'model' => Project::class,
                'orderBy' => 'id',
                'title' => 'project_name',
                'add_action' => 'editProject',
                'edit_action' => 'editProject',
                'delete_action' => 'deleteProject',
                'extra' => null,
            ],

            [
                'heading' => 'Timeline',
                'model' => Timeline::class,
                'orderBy' => 'sort_order',
                'title' => 'title',
                'add_action' => 'editTimeline',
                'edit_action' => 'editTimeline',
                'delete_action' => 'deleteTimeline',
                'extra' => 'year',
            ],

            [
                'heading' => 'Apartments',
                'model' => Apartment::class,
                'orderBy' => 'id',
                'title' => 'name',
                'add_action' => 'editApartment',
                'edit_action' => 'editApartment',
                'delete_action' => 'deleteApartment',
                'extra' => null,
            ],
        ];
    }

    protected function afterSave(): void {
        $project = $this->record;

        $gallery = $this->data['gallery'] ?? [];

        $existingImages = $project->images()
            ->pluck('image')
            ->toArray();

        // Delete images removed from the FileUpload
        $project->images()
            ->whereNotIn('image', $gallery)
            ->delete();

        // Add/update images
        foreach ($gallery as $index => $image) {

            ProjectImage::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'image' => $image,
                ],
                [
                    'sort_order' => $index,
                ]
            );
        }
    }
}

