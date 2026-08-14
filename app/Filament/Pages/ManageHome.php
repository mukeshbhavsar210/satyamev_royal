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
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ManageHome extends Page implements HasForms, HasActions {
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Home';
    protected static ?string $title = 'Home';
    protected string $view = 'filament.pages.manage-home';   

    //Projects
    protected function projectFormSchema(): array {
        return [
            Grid::make(6)
                ->schema([
                    TextInput::make('project_name')->label('Project Name')->required()
                        ->maxLength(255)->columnSpan(3),

                    Select::make('category')->label('Category')->placeholder('Select Category')
                        ->options([
                            'ongoing'   => 'Ongoing',
                            'upcoming'  => 'Upcoming',
                            'completed' => 'Completed',
                        ])
                        ->required()->columnSpan(2),
                    
                    Select::make('status')->label('Status')->placeholder('Select')
                        ->options([
                            '1' => 'Active',
                            '0' => 'Block',
                        ])
                        ->columnSpan(1),
                    
                    Textarea::make('description')->label('Project Details')->rows(3)->columnSpan(3),
                    TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(3),
                    FileUpload::make('gallery')->label('Image Gallery')->image()->multiple()->reorderable()->appendFiles()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1000:500',
                            ])
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

                    FileUpload::make('image')->label('Thumb')->image()->imageEditor()
                            ->imageEditorAspectRatios([
                                '1000:500',
                            ])
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
        ];
    }

    public function addProjectAction(): Action {
        return Action::make('addProject')
            ->label('Add Project')
            ->modalHeading('Add Project')
            ->modalWidth('4xl')
            ->schema($this->projectFormSchema())
            ->action(function (array $data) {
                $project = Project::create([
                    'project_name' => $data['project_name'],
                    'category'     => $data['category'],
                    'location'     => $data['location'],
                    'description'  => $data['description'],
                    'image'        => $data['image'] ?? null,
                    'status'       => $data['status'],
                ]);

                // Resize thumbnail
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                // Save gallery
                foreach ($data['gallery'] ?? [] as $index => $image) {
                    $this->resizeImage($image);
                    $project->images()->create([
                        'image'      => $image,
                        'sort_order' => $index,
                    ]);
                }
            });
        }    

    public function editProjectAction(): Action {
        return Action::make('editProject')
            ->modalHeading('Edit Project')
            ->modalWidth('4xl')

            ->schema($this->projectFormSchema())

            ->mountUsing(function ($form, $arguments) {

                // Check what was passed
                $projectId = $arguments['projectId'] ?? null;

                if (! $projectId) {
                    return;
                }

                $project = Project::findOrFail($projectId);

                $form->fill([
                    'project_name' => $project->project_name,
                    'category'     => $project->category,
                    'location'     => $project->location,
                    'description'  => $project->description,
                    'image'        => $project->image,
                    'gallery'      => $project->images()
                        ->orderBy('sort_order')
                        ->pluck('image')
                        ->toArray(),
                    'status'       => (string) $project->status,
                ]);
            })

            ->action(function (array $data, $arguments) {

                $projectId = $arguments['projectId'] ?? null;

                if (! $projectId) {
                    return;
                }

                $project = Project::findOrFail($projectId);

                $project->update([
                    'project_name' => $data['project_name'],
                    'category'     => $data['category'],
                    'location'     => $data['location'],
                    'description'  => $data['description'],
                    'image'        => $data['image'] ?? $project->image,
                    'status'       => $data['status'],
                ]);

                // Update gallery
                $project->images()->delete();

                foreach ($data['gallery'] ?? [] as $index => $image) {
                    if (Storage::disk('public')->exists($image)) {
                        $fullPath = Storage::disk('public')->path($image);
                        Image::read($fullPath)->cover(1000, 500)->save($fullPath);
                    }

                    $project->images()->create([
                        'image'      => $image,
                        'sort_order' => $index,
                    ]);
                }
            });
    }
    
    //Timeline
    protected function timelineFormSchema(): array {
        return [
            Grid::make(4)
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),

                    TextInput::make('year')
                        ->label('Year')
                        ->required()
                        ->maxLength(5)
                        ->columnSpan(1),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0)
                        ->columnSpan(1),

                    Textarea::make('description')
                        ->label('Description')
                        ->rows(3)
                        ->columnSpan(2),

                    FileUpload::make('image')
                        ->label('Timeline Thumb')
                        ->image()
                        ->disk('public')
                        ->directory('timeline')
                        ->visibility('public')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file, $get) =>
                                \Illuminate\Support\Str::slug($get('title'))
                                . '-'
                                . $get('year')
                                . '.'
                                . $file->getClientOriginalExtension()
                        )
                        ->columnSpan(2),
                ]),
        ];
    }

    public function addTimelineAction(): Action {
        return Action::make('addTimeline')
            ->label('Add Timeline')
            ->modalHeading('Add Timeline')
            ->modalWidth('4xl')
            ->schema($this->timelineFormSchema())

            ->action(function (array $data): void {
                Timeline::create([
                    'title'       => $data['title'],
                    'year'        => $data['year'],
                    'description' => $data['description'] ?? null,
                    'image'       => $data['image'] ?? null,
                    'sort_order'  => $data['sort_order'] ?? 0,
                ]);

                // Resize image
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }

    public function editTimelineAction(): Action {
        return Action::make('editTimeline')
            ->modalHeading('Edit Timeline')
            ->modalWidth('4xl')
            ->schema($this->timelineFormSchema())

            ->mountUsing(function ($form, $arguments) {

                $timelineId = $arguments['timelineId'] ?? null;

                if (! $timelineId) {
                    return;
                }

                $timeline = Timeline::findOrFail($timelineId);

                $form->fill([
                    'title'       => $timeline->title,
                    'year'        => $timeline->year,
                    'description' => $timeline->description,
                    'image'       => $timeline->image,
                    'sort_order'  => $timeline->sort_order,
                ]);
            })

            ->action(function (array $data, $arguments): void {

                $timelineId = $arguments['timelineId'] ?? null;

                if (! $timelineId) {
                    return;
                }

                $timeline = Timeline::findOrFail($timelineId);

                $timeline->update([
                    'title'       => $data['title'],
                    'year'        => $data['year'],
                    'description' => $data['description'] ?? null,
                    'image'       => $data['image'] ?? $timeline->image,
                    'sort_order'  => $data['sort_order'] ?? 0,
                ]);

                $this->redirect(static::getUrl());
            });
    }            

    //Apartments
    protected function apartmentFormSchema(): array {
        return [
            Grid::make(6)
                ->schema([
                    TextInput::make('name')
                        ->label('Apartment Name')
                        ->required()
                        ->maxLength(100)
                        ->columnSpan(4),

                    TextInput::make('size')->label('Size')->maxLength(100)->columnSpan(2),
                    TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(4),
                    Select::make('status')->label('Status')
                        ->options([
                            '1' => 'Active',
                            '0' => 'Block',
                        ])
                        ->columnSpan(2),

                    Textarea::make('description')->label('Description')->rows(3)->columnSpan(4),
                    FileUpload::make('image')->label('Apartment Image')->image()->imageEditor()
                        ->imageEditorAspectRatios([
                            '1000:500',
                        ])
                        ->disk('public')
                        ->directory('apartments')
                        ->visibility('public')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file, $get) =>
                                Str::slug($get('name'))
                                . '-'
                                . now()->format('YmdHis')
                                . '.'
                                . $file->getClientOriginalExtension()
                        )
                        ->columnSpan(2),
                ]),
        ];
    }

    public function addApartmentAction(): Action {
        return Action::make('addApartment')
            ->label('Add Apartment')
            ->modalHeading('Add Apartment')
            ->modalWidth('4xl')
            ->schema($this->apartmentFormSchema())

            ->action(function (array $data): void {

                $apartment = Apartment::create([
                    'name'        => $data['name'],
                    'size'        => $data['size'] ?? null,
                    'location'    => $data['location'] ?? null,
                    'description' => $data['description'] ?? null,
                    'image'       => $data['image'] ?? null,
                    'status'      => $data['status'],
                ]);

                // Resize apartment image
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }

    public function editApartmentAction(): Action {
        return Action::make('editApartment')
            ->modalHeading('Edit Apartment')
            ->modalWidth('4xl')
            ->schema($this->apartmentFormSchema())

            ->mountUsing(function ($form, $arguments) {

                $apartmentId = $arguments['apartmentId'] ?? null;

                if (!$apartmentId) {
                    return;
                }

                $apartment = Apartment::findOrFail($apartmentId);

                $form->fill([
                    'name'        => $apartment->name,
                    'size'        => $apartment->size,
                    'location'    => $apartment->location,
                    'description' => $apartment->description,
                    'image'       => $apartment->image,
                    'status'      => (string) $apartment->status,
                ]);
            })

            ->action(function (array $data, $arguments): void {

                $apartmentId = $arguments['apartmentId'] ?? null;

                if (!$apartmentId) {
                    return;
                }

                $apartment = Apartment::findOrFail($apartmentId);

                $apartment->update([
                    'name'        => $data['name'],
                    'size'        => $data['size'] ?? null,
                    'location'    => $data['location'] ?? null,
                    'description' => $data['description'] ?? null,
                    'image'       => $data['image'] ?? $apartment->image,
                    'status'      => $data['status'],
                ]);

                // Resize image only when supplied
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }    

    public function deleteRecordAction(): Action {
        return Action::make('deleteRecord')
            ->requiresConfirmation()
            ->modalHeading('Delete Record')
            ->modalDescription('Are you sure you want to delete this record?')
            ->modalSubmitActionLabel('Delete')
            ->color('danger')

            ->action(function (array $arguments): void {
                $modelClass = $arguments['model'] ?? null;
                $recordId   = $arguments['recordId'] ?? null;

                if (! $modelClass || ! $recordId) {
                    return;
                }

                $record = $modelClass::findOrFail($recordId);

                if (! empty($record->image)) {
                    $this->deleteImage($record->image);
                }

                if ($record instanceof Project) {
                    foreach ($record->images as $image) {
                        $this->deleteImage($image->image);
                    }
                    $record->images()->delete();
                }

                $record->delete();

                $this->redirect(static::getUrl());
            });
        }

    protected function deleteImage(?string $imagePath): void {
        if (! empty($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    protected function resizeImage(string $imagePath): void {
        if (!Storage::disk('public')->exists($imagePath)) {
            return;
        }

        $fullPath = Storage::disk('public')->path($imagePath);
        Image::read($fullPath)->cover(1000, 500)->save($fullPath);
    }

    public function getCardSections(): array {
        return [
            [
                'heading' => 'Projects',
                'singular' => 'Project',
                'model' => Project::class,
                'orderBy' => 'id',
                'title' => 'project_name',
                'add_action' => 'addProject',
                'edit_action' => 'editProject',
                'edit_argument' => 'projectId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> 'projectId',
                'extra' => null,
            ],
            [
                'heading' => 'Timeline',
                'singular' => 'Timeline',
                'model' => Timeline::class,
                'orderBy' => 'sort_order',
                'title' => 'title',
                'add_action' => 'addTimeline',
                'edit_action' => 'editTimeline',
                'edit_argument' => 'timelineId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> 'timelineId',
                'extra' => 'year',
            ],
            [
                'heading' => 'Apartments',
                'singular' => 'Apartment',
                'model' => Apartment::class,
                'orderBy' => 'id',
                'title' => 'name',
                'add_action' => 'addApartment',
                'edit_action' => 'editApartment',
                'edit_argument' => 'apartmentId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> 'apartmentId',
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

