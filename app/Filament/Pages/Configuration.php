<?php

namespace App\Filament\Pages;

use App\Models\Apartment;
use App\Models\Why;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Event;
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
    public $activeTab = 0;

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
                            Grid::make(6)
                                ->schema([
                                    TextInput::make('rera')->label('Rera')->columnSpan(3),
                                    TextInput::make('year')->label('Year')->numeric()->columnSpan(2),
                                    Toggle::make('timeline')->label('Timeline')->default(true)->inline(false)->dehydrateStateUsing(fn ($state) => $state ? 'yes' : 'no')->required()->columnSpan(1),
                                ]),

                            Grid::make(2)
                                ->schema([                                
                                    FileUpload::make('image')->label('Image')->acceptedFileTypes(['image/*','application/pdf',])
                                        ->disk('public')->directory('projects')->visibility('public')
                                        ->helperText('Size: 1000×700px. Max file size: 2 MB')
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
                                            ->label('PDF')
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

                            Toggle::make('show')->label('Show on Page')->default(true)->inline(false)->dehydrateStateUsing(fn ($state) => $state ? 'yes' : 'no')->required(),
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
                    'location'    => $data['location'] ?? null,
                    'image'       => $data['image'] ?? null,
                    'pdf'         => $data['pdf'] ?? null,
                    'units'       => $data['units'] ?? null,
                    'rera'        => $data['rera'] ?? null,
                    'completion'  => $data['completion'] ?? null,
                    'year'        => $data['year'] ?? null,
                    'timeline'    => $data['timeline'] ?? null,
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
                    'year'        => $project->year,
                    'timeline'    => $project->timeline,
                    'show'       => (string) $project->show,                    
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
                    'year'        => $data['year'] ?? $project->year,
                    'timeline'    => $data['timeline'] ?? $project->timeline,
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
            Grid::make(2)
                ->schema([
                    Grid::make(2)
                        ->schema([                            
                            Select::make('project_id')->label('Project')->placeholder('Select Project')
                                ->options(
                                    \App\Models\Project::query()->pluck('title', 'id')->toArray()
                                )->searchable()->preload()->required()->columnSpan(2),
                            Textarea::make('description')->label('Details')->rows(3)->columnSpan(2),                            
                        ])->columnSpan(1),
                    Grid::make(2)
                        ->schema([
                             Grid::make(5)
                                    ->schema([
                                        TextInput::make('rooms')->label('Rooms')->maxLength(10)->columnSpan(2),
                                        TextInput::make('area')->label('Area')->maxLength(10)->columnSpan(2),
                                        Toggle::make('show')->label('Show')->default(true)->inline(false)->dehydrateStateUsing(fn ($state) => $state ? 'yes' : 'no')->required()->columnSpan(1),
                                    ])->columnSpan(2),
                            
                            FileUpload::make('gallery')->label('Gallery Images')->image()->multiple()
                                ->maxFiles(5)->reorderable()->appendFiles()->imageEditor()
                                ->imageEditorAspectRatios(['1000:800',])
                                ->disk('public')->directory('apartments/gallery')->visibility('public')
                                ->helperText('Max 5 images. Size: 1000×800px. Max file size: 2 MB')
                                ->getUploadedFileNameForStorageUsing(
                                    fn ($file, $get) =>
                                        \Illuminate\Support\Str::slug($get('apartment_name'))
                                        . '-'
                                        . now()->format('Y-m-d')
                                        . '-'
                                        . \Illuminate\Support\Str::random(3)
                                        . '.'
                                        . $file->getClientOriginalExtension()
                                )->dehydrated()->columnSpan(2),                               
                        ])->columnSpan(1),
                ]),
        ];
    }

    public function addApartmentAction(): Action {
        return Action::make('addApartment')->label('Add Apartment')->modalHeading('Add Apartment')
            ->modalWidth('4xl')->schema($this->apartmentFormSchema())
            ->action(function (array $data) {
                $apartment = Apartment::create([                    
                    'project_id'     => $data['project_id'],                                                            
                    'rooms'          => $data['rooms'],
                    'area'           => $data['area'],                    
                    'description'    => $data['description'],                    
                    'show'         => $data['show'],
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
                    'project_id'     => $apartment->project_id,                        
                    'image'         => $apartment->image,                        
                    'rooms'         => $apartment->rooms,
                    'area'          => $apartment->area,                        
                    'description'   => $apartment->description,                        
                    'gallery'      => $apartment->images()->orderBy('sort_order')->pluck('image')->toArray(),
                    'show'       => (string) $apartment->show,
                ]);
            })

            ->action(function (array $data, $arguments) {
                $apartmentId = $arguments['apartmentId'] ?? null;

                if (! $apartmentId) {
                    return;
                }

                $apartment = Apartment::findOrFail($apartmentId);

                $apartment->update([                        
                    'project_id'     => $data['project_id'],
                    'category'       => $data['category'],
                    'image'          => $data['image'] ?? $apartment->image,                        
                    'rooms'          => $data['rooms'],
                    'area'           => $data['area'],                        
                    'description'    => $data['description'],                        
                    'show'           => $data['show'],
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
    
    //Why
    protected function whyFormSchema(): array {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('title')->label('Title')->columnSpan(2),
                    TextInput::make('icon')->label('Icon')->columnSpan(1),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpan(3),
                ]),
        ];
    }

    public function addWhyAction(): Action {
        return Action::make('addWhy')
            ->label('Add Why')
            ->modalHeading('Add Why')
            ->modalWidth('4xl')
            ->schema($this->whyFormSchema())

            ->action(function (array $data): void {
                Why::create([
                    'icon'        => $data['icon'],
                    'title'        => $data['title'],
                    'description' => $data['description'] ?? null,
                ]);               

                $this->redirect(static::getUrl());
            });
    }

    public function editWhyAction(): Action {
        return Action::make('editWhychoose')
            ->modalHeading('Edit Why')
            ->modalWidth('4xl')
            ->schema($this->whyFormSchema())
            ->mountUsing(function ($form, $arguments) {
                $whyId = $arguments['$whyId'] ?? null;

                if (! $whyId) {
                    return;
                }

                $why = Why::findOrFail($whyId);

                $form->fill([        
                    'icon'        => $why->icon,
                    'title'       => $why->title,
                    'description' => $why->description,                                        
                ]);
            })            
           
            ->mountUsing(function (Schema $form, array $arguments): void {
                $record = Why::findOrFail($arguments['recordId']);

                $form->fill([
                    'icon' => $record->icon,
                    'title' => $record->title,
                    'description' => $record->description,
                ]);
            })
            ->action(function (array $data, array $arguments): void {
                $record = Why::findOrFail($arguments['recordId']);

                $record->update($data);
            });
    }


    //Testimonials
    protected function testimonialFormSchema(): array {
        return [
            Grid::make(6)
                ->schema([                   
                    TextInput::make('name')->label('Name')->required()->maxLength(255)->columnSpan(3),
                    TextInput::make('designation')->label('Designation')->columnSpan(2),
                    Toggle::make('show')->label('Show')->default(true)->inline(false)->dehydrateStateUsing(fn ($state) => $state ? 'yes' : 'no')->required()->columnSpan(1),

                    TextArea::make('description')->label('Description')->columnSpan(3),
                    FileUpload::make('image')->label('Image')->image()->disk('public')
                        ->directory('settings/testimonial')
                        ->visibility('public')
                        ->helperText('Size: 300×300px. Max file size: 1 MB')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file, $get) =>
                                Str::slug($get('name'))
                                . '.'
                                . $file->getClientOriginalExtension()
                        )
                        ->columnSpan(3),                    
                ]),
        ];
    }

    public function addTestimonialAction(): Action {
        return Action::make('addTestimonial')
            ->label('Add Testimonial')
            ->modalHeading('Add Testimonial')
            ->modalWidth('4xl')
            ->schema($this->testimonialFormSchema())
            ->action(function (array $data): void {
                $testimonial = Testimonial::create([
                    'name'        => $data['name'],
                    'designation' => $data['designation'],
                    'image'       => $data['image'] ?? null,
                    'description' => $data['description'] ?? null,                    
                    'show'        => $data['show'] ?? 'yes',
                ]);
               
                $this->redirect(static::getUrl());
            });
    }

    public function editTestimonialAction(): Action {
        return Action::make('editWhychoose')
            ->modalHeading('Edit Testimonial')
            ->modalWidth('4xl')
            ->schema($this->testimonialFormSchema())
            ->mountUsing(function ($form, $arguments) {
                $testimonialId = $arguments['testimonialId'] ?? null;

                if (!$testimonialId) {
                    return;
                }

                $testimonial = Testimonial::findOrFail($testimonialId);

                $form->fill([
                    'name'        => $testimonial->name,
                    'designation' => $testimonial->designation,
                    'image'       => $testimonial->image,
                    'description' => $testimonial->description,                    
                    'show'        => (string) $testimonial->show,
                ]);
            })

            ->mountUsing(function (Schema $form, array $arguments): void {
                $record = Testimonial::findOrFail($arguments['recordId']);

                $form->fill([                    
                    'name' => $record->name,
                    'designation' => $record->designation,
                    'image' => $record->image,
                    'description' => $record->description,
                    'show' => (string) $record->show,
                ]);
            })
            ->action(function (array $data, array $arguments): void {
                $record = Testimonial::findOrFail($arguments['recordId']);

                $record->update($data);
            });
    }   


    //Events
    protected function eventFormSchema(): array {
        return [
            Grid::make(6)
                ->schema([
                    TextInput::make('title')->label('Event Title')->required()->maxLength(255)->columnSpan(5),
                    Toggle::make('show')->label('Show')->default(true)->inline(false)->dehydrateStateUsing(fn ($state) => $state ? 'yes' : 'no')->required()->columnSpan(1),
                    
                    FileUpload::make('image')->label('Image')->image()->disk('public')
                        ->directory('settings/events')
                        ->visibility('public')
                        ->helperText('Size: 1000×600px. Max file size: 1 MB')
                        ->getUploadedFileNameForStorageUsing(
                            fn ($file, $get) =>
                                Str::slug($get('title'))
                                . '.'
                                . $file->getClientOriginalExtension()
                        )
                        ->columnSpan(3),
                    TextArea::make('description')->label('Description')->columnSpan(3),
                ]),
        ];
    }

    public function addEventAction(): Action {
        return Action::make('addEvent')
            ->label('Add Event')
            ->modalHeading('Add Event')
            ->modalWidth('4xl')
            ->schema($this->eventFormSchema())
            ->action(function (array $data): void {
                $event = Event::create([
                    'title'        => $data['title'],                    
                    'image'       => $data['image'] ?? null,
                    'description' => $data['description'] ?? null,                    
                    'show'        => $data['show'] ?? 'yes',
                ]);
               
                $this->redirect(static::getUrl());
            });
    }

    public function editEventAction(): Action {
        return Action::make('editEvent')
            ->modalHeading('Edit Event')
            ->modalWidth('4xl')
            ->schema($this->eventFormSchema())
            ->mountUsing(function ($form, $arguments) {
                $eventId = $arguments['eventId'] ?? null;

                if (!$eventId) {
                    return;
                }

                $event = Event::findOrFail($eventId);

                $form->fill([
                    'title'        => $event->title,                    
                    'image'       => $event->image,
                    'description' => $event->description,                    
                    'show'        => (string) $event->show,
                ]);
            })

            ->mountUsing(function (Schema $form, array $arguments): void {
                $record = Event::findOrFail($arguments['recordId']);

                $form->fill([                    
                    'title' => $record->title,                    
                    'image' => $record->image,
                    'description' => $record->description,
                    'show' => (string) $record->show,
                ]);
            })
            ->action(function (array $data, array $arguments): void {
                $record = Event::findOrFail($arguments['recordId']);
                $record->update($data);
            });
    }   
    
    //Delete Record
    public function deleteRecordAction(): Action {
        return Action::make('deleteRecord')
            ->requiresConfirmation()->modalHeading('Delete Record')->modalDescription('Are you sure you want to delete this record?')
            ->modalSubmitActionLabel('Delete')->color('danger')

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

                if ($record instanceof Apartment) {
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

    //resize Record
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
                'heading' => 'Why',
                'singular' => 'Why',
                'model' => Why::class,                
                'title' => 'title',
                'add_action' => 'addWhy',
                'edit_action' => 'editWhy',
                'edit_argument' => '$whyId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> '$whyId',
                'extra' => 'year',
            ],
            [
                'heading' => 'Testimonial',
                'singular' => 'Testimonial',
                'model' => Testimonial::class,
                'orderBy' => 'sort_order',
                'title' => 'title',
                'add_action' => 'addTestimonial',
                'edit_action' => 'editTestimonial',
                'edit_argument' => 'testimonialId',
                'delete_action' => 'deleteRecord',
                'delete_argument' => 'testimonialId',
                'extra' => null,
            ],
            [
                'heading' => 'Event',
                'singular' => 'Event',
                'model' => Event::class,
                'orderBy' => 'sort_order',
                'title' => 'title',
                'add_action' => 'addEvent',
                'edit_action' => 'editEvent',
                'edit_argument' => 'eventId',
                'delete_action' => 'deleteRecord',
                'delete_argument' => 'eventId',
                'extra' => null,
            ],
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