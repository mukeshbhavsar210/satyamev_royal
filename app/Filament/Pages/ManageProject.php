<?php

namespace App\Filament\Pages;

use App\Models\Apartment;
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

class ManageProject extends Page implements HasForms, HasActions {
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Apartments';
    protected static ?string $title = 'Apartments';
    protected string $view = 'filament.pages.manage-project';

    //Projects
    protected function projectFormSchema(): array {
        return [
            Grid::make(3)
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('apartment_name')->label('Apartment Name')->required()->maxLength(255)->columnSpan(2),
                            TextInput::make('location')->label('Location')->maxLength(255)->columnSpan(2),
                            Textarea::make('description')->label('Project Details')->rows(2)->columnSpan(2),
                            FileUpload::make('image')->label('Thumb')->image()->imageEditor()
                                ->imageEditorAspectRatios([
                                    '600:500',
                                ])
                                ->disk('public')
                                ->directory('projects/thumb')
                                ->visibility('public')
                                ->getUploadedFileNameForStorageUsing(
                                    fn ($file, $get) =>
                                        \Illuminate\Support\Str::slug($get('apartment_name'))
                                        . '-'
                                        . now()->format('Y-m-d-His')
                                        . '.'
                                        . $file->getClientOriginalExtension()
                                )->columnSpan(1),
                            FileUpload::make('gallery')->label('Image Gallery')->image()->multiple()->reorderable()->appendFiles()->imageEditor()
                                ->imageEditorAspectRatios([
                                    '1000:800',
                                ])
                                ->disk('public')->directory('projects/gallery')->visibility('public')
                                ->getUploadedFileNameForStorageUsing(
                                    fn ($file, $get) =>
                                        \Illuminate\Support\Str::slug($get('apartment_name'))
                                        . '-'
                                        . now()->format('Y-m-d-His')
                                        . '-'
                                        . uniqid()
                                        . '.'
                                        . $file->getClientOriginalExtension()
                                )->columnSpan(1),
                        ])->columnSpan(2),
                    Grid::make(2)
                        ->schema([       
                            Select::make('project_id')->label('Project')->placeholder('Select Project')
                                ->options(
                                    \App\Models\Project::query()
                                        ->pluck('project_name', 'id')
                                        ->toArray()
                                )
                                ->searchable()->preload()->required()->columnSpan(2),             
                            Select::make('category')->label('Category')->placeholder('Select Category')
                                ->options([
                                    'ongoing'   => 'Ongoing',
                                    'upcoming'  => 'Upcoming',
                                    'completed' => 'Completed',
                                ])
                                ->required() ->default('ongoing')->columnSpan(2),
                            DatePicker::make('completion')->label('Completion')->displayFormat('F Y')->format('Y-m')->native(false)->closeOnDateSelection()->columnSpan(2),
                            TextInput::make('units')->label('Units')->maxLength(10)->columnSpan(2),
                            Select::make('status')->label('Status')->placeholder('Select')
                                ->options([
                                    '1' => 'Active',
                                    '0' => 'Block',
                                ]) ->default(1)->columnSpan(2),
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
            ->action(function (array $data) {
                $project = Apartment::create([
                    'apartment_name' => $data['apartment_name'],                    
                    'project_id'     => $data['project_id'],
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

                $project = Apartment::findOrFail($projectId);

                $form->fill([
                    'apartment_name' => $project->apartment_name,
                    'project_id'     => $project->project_id,
                    'category'     => $project->category,
                    'location'     => $project->location,
                    'description'  => $project->description,
                    'image'        => $project->image,
                    // 'gallery'      => $project->images()
                    //     ->orderBy('sort_order')
                    //     ->pluck('image')
                    //     ->toArray(),
                    'status'       => (string) $project->status,
                ]);
            })

            ->action(function (array $data, $arguments) {

                $projectId = $arguments['projectId'] ?? null;

                if (! $projectId) {
                    return;
                }

                $project = Apartment::findOrFail($projectId);

                $project->update([
                    'apartment_name' => $data['apartment_name'],
                    'project_id'     => $data['project_id'],
                    'category'     => $data['category'],
                    'location'     => $data['location'],
                    'description'  => $data['description'],
                    'image'        => $data['image'] ?? $project->image,
                    'status'       => $data['status'],
                ]);

                // Update gallery
                //$project->images()->delete();

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
                'heading' => 'Apartments',
                'singular' => 'Apartment',
                'model' => Apartment::class,
                'orderBy' => 'id',
                'title' => 'apartment_name',
                'add_action' => 'addProject',
                'edit_action' => 'editProject',
                'edit_argument' => 'projectId',
                'delete_action' => 'deleteRecord',
                'delete_argument'=> 'projectId',
                'extra' => null,
            ]
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

