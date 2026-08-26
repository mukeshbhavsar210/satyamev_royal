<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Filament\Resources\Pages\Schemas\PageForm;
use App\Filament\Resources\Pages\Tables\PagesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PageResource extends Resource {
    protected static ?string $model = Page::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'Page';

    public static function form(Schema $schema): Schema {
        //return PageForm::configure($schema);

        return $schema
            ->components([
                Section::make('Page Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('title')->required()->maxLength(100)
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    })->columnSpan(2),

                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('draft')->required()->columnSpan(1), 

                                RichEditor::make('content')->columnSpan(2),
                                
                                Hidden::make('slug')->default(fn () => \Illuminate\Support\Str::slug(request()->input('title', ''))),

                                FileUpload::make('featured_image')->label('Featured Image')->image()->disk('public')
                                    ->directory('pages')->visibility('public')
                                    ->getUploadedFileNameForStorageUsing(function ($file, $get) {
                                        $title = $get('title');
                                        $slug = Str::slug($title);
                                        $date = now()->format('Y-m-d');
                                        $extension = $file->getClientOriginalExtension();
                                        return $slug . '-' . $date . '.' . $extension;
                                    })->columnSpan(1),

                                Textarea::make('meta_description')->rows(3)->columnSpan(2),
                                TextInput::make('meta_title')->maxLength(255)->columnSpan(1),
                            ])->columnSpan(3),                                                                           
                ])->columnSpanFull()->collapsible(),

                Section::make('Gallery')
                    ->schema([
                        Placeholder::make('images_preview')->hiddenLabel()->label('Preview')
                            ->content(function ($record) {
                                if (!$record || $record->images->isEmpty()) {
                                    return 'No images uploaded.';
                                }

                                $html = '<h2 style="font-size:18px; margin-bottom:10px;">
                                            Uploaded Images
                                        </h2>

                                        <div style="
                                            display:grid;
                                            grid-template-columns:repeat(6, 1fr);
                                            gap:10px;
                                            margin-top:10px;
                                        ">';

                                    foreach ($record->images as $image) {
                                        $url = Storage::url($image->image);
                                        $html .= '<img src="' . $url . '" style="width:150px; height:150px; object-fit:cover; border-radius:8px;">';}
                                $html .= '</div>';

                                return new \Illuminate\Support\HtmlString($html);
                            })->columnSpan(1),

                        Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('image')
                                    ->hiddenLabel()->image()->disk('public')->directory('pages/images')->required()
                                    ->afterStateUpdated(function ($state, $get, $set) {
                                        if (empty($state)) {
                                            return;
                                        }

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

                                        $sizes = [500, 800, 1080, 1600, 1920];
                                        $random = Str::random(6);
                                        $generatedImages = [];

                                        foreach ($sizes as $width) {
                                            $filename = "{$random}-{$width}.webp";
                                            $relativePath = "pages/images/{$filename}";
                                            $fullPath = Storage::disk('public')->path($relativePath);
                                            $image = $manager->read($sourcePath);

                                            // Don't enlarge smaller images
                                            if ($image->width() > $width) {
                                                $image->scale(width: $width);
                                            }

                                            $image->toWebp(85)->save($fullPath);
                                            $generatedImages[$width] = $relativePath;
                                        }

                                        // Store JSON in the repeater field
                                        $set('image', $generatedImages);

                                        // Delete original uploaded image
                                        Storage::disk('public')->delete($path);
                                    }),                                    
                                ])->reorderable(),
            ])->columnSpanFull()->collapsible(),
        ]);
    }   

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),                
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
    
}
