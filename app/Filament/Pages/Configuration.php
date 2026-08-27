<?php

namespace App\Filament\Pages;

use App\Models\Apartment;
use App\Models\Timeline;
use App\Models\Slide;
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

    //Apartments
    protected function apartmentFormSchema(): array {
        return [
            Grid::make(3)
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('apartment_name')->label('Apartment Name')->required()->maxLength(255)->columnSpan(2),
                            TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(2),
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
                        ])->columnSpan(2),
                    Grid::make(2)
                        ->schema([       
                            Select::make('project_id')->label('Project')->placeholder('Select Project')
                                ->options(
                                    \App\Models\Project::query()
                                        ->pluck('project_name', 'id')
                                        ->toArray()
                                )->searchable()->preload()->required()->columnSpan(2),             
                            Select::make('category')->label('Category')->placeholder('Select Category')
                                ->options([
                                    'ongoing'   => 'Ongoing',
                                    'upcoming'  => 'Upcoming',
                                    'completed' => 'Completed',
                                ])
                                ->required() ->default('ongoing')->columnSpan(2),
                            DatePicker::make('completion')->label('Completion')->displayFormat('F Y')->format('Y-m')->native(false)->closeOnDateSelection()->columnSpan(1),
                            TextInput::make('rooms')->label('Rooms')->maxLength(10)->columnSpan(1),
                            TextInput::make('area')->label('Area')->maxLength(10)->columnSpan(1),
                            TextInput::make('units')->label('Units')->maxLength(10)->columnSpan(1),
                            Select::make('status')->label('Status')->placeholder('Select')
                                ->options([
                                    '1' => 'Active',
                                    '0' => 'Block',
                                ]) ->default(1)->columnSpan(2),
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
                    TextInput::make('year')->label('Year')->required()->maxLength(5)->columnSpan(1),
                    TextInput::make('title')->label('Title')->required()->maxLength(255)->columnSpan(2),                    
                    TextInput::make('sort_order')->label('Sort Order')->numeric()->default(0)->columnSpan(1),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpan(2),
                    FileUpload::make('image')->label('Timeline Thumb')->image()->disk('public')->directory('timeline')->visibility('public')
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

    //Slides
    protected function slideFormSchema(): array {
        return [
            Grid::make(4)
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextInput::make('title')->label('Slide Title')->required()->maxLength(255),
                            TextInput::make('description')->label('Description'),                            
                            FileUpload::make('image')->label('Slide Image')->image()->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1920:700',
                                    ])
                                    ->disk('public')
                                    ->directory('settings/slides')
                                    ->visibility('public')
                                    ->getUploadedFileNameForStorageUsing(
                                        fn ($file, $get) =>
                                            Str::slug($get('title'))
                                            . '-'
                                            . now()->format('YmdHis')
                                            . '.'
                                            . $file->getClientOriginalExtension()
                                    ),
                        ])->columnSpan(3),
                    Grid::make(1)
                        ->schema([
                            TextInput::make('size')->label('Size'),
                            TextInput::make('sort_order')->label('Sort Order')->numeric()->default(1),
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    '1' => 'Active',
                                    '0' => 'Block',
                                ])
                                ->default('1')->required(),
                        ])->columnSpan(1),
                ]),
        ];
    }

    public function addSlideAction(): Action {
        return Action::make('addSlide')
            ->label('Add Slide')
            ->modalHeading('Add Slide')
            ->modalWidth('4xl')
            ->schema($this->slideFormSchema())

            ->action(function (array $data): void {

                $slide = Slide::create([
                    'title'       => $data['title'],
                    'image'       => $data['image'] ?? null,
                    'description' => $data['description'] ?? null,
                    'sort_order'  => $data['sort_order'] ?? 0,
                    'status'      => $data['status'] ?? '1',
                ]);

                // Resize slide image
                if (!empty($data['image'])) {
                    $this->resizeImage($data['image']);
                }

                $this->redirect(static::getUrl());
            });
    }

    public function editSlideAction(): Action {
        return Action::make('editSlide')
            ->modalHeading('Edit Slide')
            ->modalWidth('4xl')
            ->schema($this->slideFormSchema())

            ->mountUsing(function ($form, $arguments) {

                $slideId = $arguments['slideId'] ?? null;

                if (!$slideId) {
                    return;
                }

                $slide = Slide::findOrFail($slideId);

                $form->fill([
                    'title'       => $slide->title,
                    'image'       => $slide->image,
                    'description' => $slide->description,
                    'sort_order'  => $slide->sort_order,
                    'status'      => (string) $slide->status,
                ]);
            })

            ->action(function (array $data, $arguments): void {

                $slideId = $arguments['slideId'] ?? null;

                if (!$slideId) {
                    return;
                }

                $slide = Slide::findOrFail($slideId);

                $slide->update([
                    'title'       => $data['title'],
                    'image'       => $data['image'] ?? $slide->image,
                    'description' => $data['description'] ?? null,
                    'sort_order'  => $data['sort_order'] ?? 0,
                    'status'      => $data['status'] ?? '1',
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
                'heading' => 'Slides',
                'singular' => 'Slide',
                'model' => Slide::class,
                'orderBy' => 'sort_order',
                'title' => 'title',
                'add_action' => 'addSlide',
                'edit_action' => 'editSlide',
                'edit_argument' => 'slideId',
                'delete_action' => 'deleteRecord',
                'delete_argument' => 'slideId',
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