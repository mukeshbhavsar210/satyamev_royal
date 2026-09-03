<?php

namespace App\Filament\Pages;

use App\Models\Apartment;
use App\Models\Timeline;
use App\Models\Project;
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
use Filament\Forms\Components\DatePicker;

class Configuration extends Page implements HasForms, HasActions {
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Configuration';
    protected static ?string $title = 'Configuration';
    protected string $view = 'filament.configuration';

    //Projects
    protected function projectFormSchema(): array {
        return [
            Grid::make(4)
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextInput::make('title')->label('Project Title')->required()->maxLength(255),
                            TextInput::make('location')->label('Location')->required()->maxLength(255),
                            TextInput::make('description')->label('Description'),
                            TextInput::make('rera')->label('Rera'),

                            Grid::make(2)
                                ->schema([                                
                                    FileUpload::make('image')->label('Project Image')->acceptedFileTypes(['image/*','application/pdf',])
                                        ->disk('public')->directory('projects')->visibility('public')
                                        ->directory(fn ($get) => 'projects')
                                        ->getUploadedFileNameForStorageUsing(
                                            function ($file, $get, $record) {
                                                $title = $get('title') ?? 'project';
                                                return Str::slug($title)
                                                    . '.'
                                                    . $file->getClientOriginalExtension();
                                            }
                                        )->columnSpan(1),

                                        FileUpload::make('pdf')
                                            ->label('Project PDF')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->disk('public')
                                            ->directory('projects')
                                            ->visibility('public')
                                            ->downloadable()
                                            ->openable()
                                            ->getUploadedFileNameForStorageUsing(
                                                fn ($file, $get) =>
                                                    Str::slug($get('title'))                                                    
                                                    . '.pdf'
                                            ),                                        
                                ]),
                        ])->columnSpan(3),
                    Grid::make(1)
                        ->schema([
                            Select::make('category')->label('Category')
                                ->options([
                                    'ongoing' => 'Ongoing',
                                    'upcoming' => 'Upcoming',
                                    'completed' => 'Completed',
                                ])
                                ->default('ongoing')->required(),
                                                        
                            TextInput::make('units')->label('Units'),
                            DatePicker::make('completion')->label('Completion')->displayFormat('F Y')->format('Y-m')->native(false)->closeOnDateSelection()->columnSpan(1),

                            Select::make('show')->label('Show on Page')
                                ->options([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                ])
                                ->default('yes')->required(),
                        ])->columnSpan(1),
                ]),
        ];
    }

    public function addProjectAction(): Action {
        return Action::make('addProject')
            ->label('Add Project')
            ->modalHeading('Add Project')
            ->modalWidth('4xl')
            ->schema($this->projectFormSchema())

            ->action(function (array $data): void {

                $project = Project::create([
                    'title'       => $data['title'],
                    'category'    => $data['category'] ?? null,
                    'image'       => $data['image'] ?? null,
                    'pdf'         => $data['pdf'] ?? null,
                    'units'       => $data['units'] ?? null,
                    'rera'         => $data['rera'] ?? null,
                    'completion'  => $data['completion'] ?? null,
                    'description' => $data['description'] ?? null,                    
                    'show'        => $data['show'] ?? 'yes',
                ]);

                // Resize Project image
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }

    public function editProjectAction(): Action {
        return Action::make('editProject')
            ->modalHeading('Edit Project')
            ->modalWidth('4xl')
            ->schema($this->projectFormSchema())

            ->mountUsing(function ($form, $arguments) {

                $projectId = $arguments['recordId'] ?? null;

                if (!$projectId) {
                    return;
                }

                $project = Project::findOrFail($projectId);

                $form->fill([
                    'title'       => $project->title,
                    'category'    => $project->category,
                    'location'    => $project->location,
                    'image'       => $project->image,
                    'pdf'         => $project->pdf,
                    'rera'        => $project->rera,                    
                    'completion'  => $project->completion,
                    'units'       => $project->units,                    
                    'description' => $project->description,
                    'show'      => (string) $project->show,                    
                ]);
            })

            ->action(function (array $data, $arguments): void {
                $projectId = $arguments['recordId'] ?? null;

                if (!$projectId) {
                    return;
                }

                $project = Project::findOrFail($projectId);

                $project->update([
                    'title'       => $data['title'],
                    'category'    => $data['category'] ?? $project->category,
                    'image'       => $data['image'] ?? $project->image,
                    'rera'        => $data['rera'] ?? $project->rera,
                    'pdf'         => $data['pdf'] ?? $project->pdf,
                    'completion'  => $data['completion'] ?? $project->completion,
                    'units'       => $data['units'] ?? $project->units,
                    'location'    => $data['location'] ?? $project->location,
                    'description' => $data['description'] ?? null,                    
                    'show'        => $data['show'] ?? $project->show,
                ]);

                // Resize image only when a new image is supplied
                if (!empty($data['image']) && $data['image'] !== $project->image) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }


    //Apartments
    protected function apartmentFormSchema(): array {
        return [
            Grid::make(4)
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('apartment_name')->label('Apartment Name')->required()->maxLength(255)->columnSpan(2),                            
                            Textarea::make('description')->label('Apartment Details')->rows(2)->columnSpan(2),
                            FileUpload::make('image')->label('Thumb')->image()->imageEditor()
                                ->imageEditorAspectRatios([
                                    '600:500',
                                ])
                                ->disk('public')->directory('apartments/thumb')->visibility('public')
                                ->getUploadedFileNameForStorageUsing(
                                    fn ($file, $get) =>
                                        \Illuminate\Support\Str::slug($get('apartment_name'))
                                        . '-'
                                        . now()->format('Y-m-d')
                                        . '.'
                                        . $file->getClientOriginalExtension()
                                )->columnSpan(1),
                            FileUpload::make('gallery')->label('Image Gallery')->image()->multiple()->reorderable()->appendFiles()->imageEditor()
                                ->imageEditorAspectRatios([
                                    '1000:800',
                                ])
                                ->disk('public')->directory('apartments/gallery')->visibility('public')
                                ->getUploadedFileNameForStorageUsing(
                                    fn ($file, $get) =>
                                        \Illuminate\Support\Str::slug($get('apartment_name'))
                                        . '-'
                                        . now()->format('Y-m-d')
                                        . '-'
                                        . \Illuminate\Support\Str::random(3)
                                        . '.'
                                        . $file->getClientOriginalExtension()
                                )->dehydrated()->columnSpan(1),
                        ])->columnSpan(3),
                    Grid::make(2)
                        ->schema([       
                            Select::make('project_id')->label('Project')->placeholder('Select Project')
                                ->options(
                                    \App\Models\Project::query()->pluck('title', 'id')->toArray()
                                )->searchable()->preload()->required()->columnSpan(2),             
                                                        
                            TextInput::make('rooms')->label('Rooms')->maxLength(10)->columnSpan(2),
                            TextInput::make('area')->label('Area')->maxLength(10)->columnSpan(2),                            
                             Select::make('show')->label('Show on Page')
                                ->options([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                ])
                                ->default('yes')->required()->columnSpan(2),                            
                        ])->columnSpan(1),
                ]),
        ];
    }

    public function addApartmentAction(): Action {
        return Action::make('addApartment')->label('Add Apartment')->modalHeading('Add Apartment')
            ->modalWidth('4xl')->schema($this->apartmentFormSchema())
            ->action(function (array $data) {
                $apartment = Apartment::create([
                    'apartment_name' => $data['apartment_name'],                    
                    'project_id'     => $data['project_id'],
                    'category'       => $data['category'],
                    'image'          => $data['image'] ?? null,
                    'location'       => $data['location'],
                    'rooms'          => $data['rooms'],
                    'area'           => $data['area'],
                    'units'          => $data['units'],                    
                    'description'    => $data['description'],
                    'completion'     => $data['completion'],
                    'status'         => $data['status'],
                ]);

                // Resize thumbnail
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                // Save gallery
                foreach ($data['gallery'] ?? [] as $index => $image) {
                    $this->resizeImage($image);
                    $apartment->images()->create([
                        'image'      => $image,
                        'sort_order' => $index,
                    ]);
                }
            });
        }    

    
        public function editApartmentAction(): Action {
            return Action::make('editApartment')
                ->modalHeading('Edit Apartment')->modalWidth('4xl')->schema($this->apartmentFormSchema())
                ->mountUsing(function ($form, $arguments) {
                    // Check what was passed
                    $apartmentId = $arguments['apartmentId'] ?? null;

                    if (! $apartmentId) {
                        return;
                    }

                    $apartment = Apartment::findOrFail($apartmentId);

                    $form->fill([
                        'apartment_name' => $apartment->apartment_name,
                        'project_id'     => $apartment->project_id,
                        'category'      => $apartment->category,
                        'image'         => $apartment->image,
                        'location'      => $apartment->location,
                        'rooms'         => $apartment->rooms,
                        'area'          => $apartment->area,
                        'units'         => $apartment->units,
                        'description'   => $apartment->description,
                        'completion'    => $apartment->completion,
                        'gallery'      => $apartment->images()->orderBy('sort_order')->pluck('image')->toArray(),
                        'status'       => (string) $apartment->status,
                    ]);
                })

                ->action(function (array $data, $arguments) {
                    $apartmentId = $arguments['apartmentId'] ?? null;

                    if (! $apartmentId) {
                        return;
                    }

                    $apartment = Apartment::findOrFail($apartmentId);

                    $apartment->update([
                        'apartment_name' => $data['apartment_name'],
                        'project_id'     => $data['project_id'],
                        'category'       => $data['category'],
                        'image'          => $data['image'] ?? $apartment->image,
                        'location'     => $data['location'],
                        'rooms'     => $data['rooms'],
                        'area'     => $data['area'],
                        'units'     => $data['units'],
                        'description'  => $data['description'],
                        'completion'  => $data['completion'],                        
                        'status'       => $data['status'],
                    ]);

                    // Update gallery
                    $apartment->images()->delete();

                    foreach ($data['gallery'] ?? [] as $index => $image) {
                        if (Storage::disk('public')->exists($image)) {
                            $fullPath = Storage::disk('public')->path($image);
                            Image::read($fullPath)->cover(1000, 700)->save($fullPath);
                        }

                        $apartment->images()->create([
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
                    Select::make('year')->label('Year')->options(
                            collect(range(2000, 2026))
                                ->mapWithKeys(fn ($year) => [$year => $year])
                                ->toArray()
                        )->required()->columnSpan(1),                    
                    TextInput::make('title')->label('Title')->required()->maxLength(255)->columnSpan(2),
                    TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->columnSpan(1),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpan(4),
                    FileUpload::make('image')->label('Timeline Thumb')->image()->disk('public')->directory('timeline')->visibility('public')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file, $get) =>
                                \Illuminate\Support\Str::slug($get('title'))
                                . '-'
                                . $get('year')
                                . '.'
                                . $file->getClientOriginalExtension()
                        )
                        ->columnSpan(4),
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
    
    public function deleteRecordAction(): Action
{
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

            /*
            |--------------------------------------------------------------------------
            | Delete main image
            |--------------------------------------------------------------------------
            */

            if (! empty($record->image)) {
                $this->deleteFile($record->image);
            }

            /*
            |--------------------------------------------------------------------------
            | Delete PDF
            |--------------------------------------------------------------------------
            */

            if ($record instanceof Apartment && ! empty($record->pdf)) {
                $this->deleteFile($record->pdf);
            }

            /*
            |--------------------------------------------------------------------------
            | Delete Apartment Gallery
            |--------------------------------------------------------------------------
            */

            if ($record instanceof Apartment) {

                foreach ($record->images as $image) {
                    if (! empty($image->image)) {
                        $this->deleteFile($image->image);
                    }
                }

                $record->images()->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Delete Record
            |--------------------------------------------------------------------------
            */

            $record->delete();

            $this->redirect(static::getUrl());
        });
}
        
    // public function deleteRecordAction(): Action {
    //     return Action::make('deleteRecord')
    //         ->requiresConfirmation()->modalHeading('Delete Record')->modalDescription('Are you sure you want to delete this record?')
    //         ->modalSubmitActionLabel('Delete')->color('danger')

    //         ->action(function (array $arguments): void {
    //             $modelClass = $arguments['model'] ?? null;
    //             $recordId   = $arguments['recordId'] ?? null;

    //             if (! $modelClass || ! $recordId) {
    //                 return;
    //             }

    //             $record = $modelClass::findOrFail($recordId);

    //             if (! empty($record->image)) {
    //                 $this->deleteImage($record->image);
    //             }

    //             if ($record instanceof Apartment) {
    //                 foreach ($record->images as $image) {
    //                     $this->deleteImage($image->image);
    //                 }
    //                 $record->images()->delete();
    //             }
                
    //             $record->delete();

    //             $this->redirect(static::getUrl());
    //         });
    //     }

    
    //     protected function deleteImage(?string $imagePath): void {
    //     if (! empty($imagePath)) {
    //         Storage::disk('public')->delete($imagePath);
    //     }
    // }

    protected function resizeImage(string $imagePath): void {
        if (!Storage::disk('public')->exists($imagePath)) {
            return;
        }

        $fullPath = Storage::disk('public')->path($imagePath);
        Image::read($fullPath)->cover(1000, 700)->save($fullPath);
    }

    public function getCardSections(): array {
        return [
            [
                'heading' => 'Projects',
                'singular' => 'Project',
                'model' => Project::class,                
                'title' => 'title',
                'add_action' => 'addProject',
                'edit_action' => 'editProject',
                'edit_argument' => 'projectId',
                'delete_action' => 'deleteRecord',
                'delete_argument' => 'projectId',
                'extra' => null,
            ],
            [
                'heading' => 'Apartments',
                'singular' => 'Apartment',
                'model' => Apartment::class,
                'orderBy' => 'id',
                'title' => 'apartment_name',
                'add_action' => 'addApartment',
                'edit_action' => 'editApartment',
                'edit_argument' => 'apartmentId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> 'apartmentId',
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
            ]
        ];
    }

    protected function afterSave(): void {
        $apartment = $this->record;
        $gallery = $this->data['gallery'] ?? [];

        // Remove database records for images no longer selected
        $apartment->images()->whereNotIn('image', $gallery)->delete();
      
        // Add/update images
        foreach ($gallery as $index => $image) {
            ApartmentImage::updateOrCreate(
                [
                    'apartment_id' => $apartment->id,
                    'image' => $image,
                ],
                [
                    'sort_order' => $index,
                ]
            );
        }
    }
}