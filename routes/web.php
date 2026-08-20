<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Timeline;
use App\Models\Project;
use App\Models\Apartment;
use App\Models\Setting;
use App\Models\Slide;

Route::get('/', function () {
    $slides = Slide::where('status', 1)->orderBy('sort_order')->get();
    $timelines = Timeline::orderBy('sort_order')->get();
    $floatingTips = Apartment::where('status', 1)->get();
    $projects = Apartment::where('status', 1)->take(10)->get();       

    return view('home.index', compact('slides', 'floatingTips', 'projects', 'timelines'));
});

Route::get('/apartments', function () {
    $category = array_key_first(request()->query());

    $apartments = Apartment::query()
        ->when($category && in_array($category, ['ongoing', 'completed', 'upcoming']), function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->get();

    $floatingTips = Apartment::select('category')
        ->distinct()
        ->get();    

    return view('apartments.index', compact('apartments', 'floatingTips'));
});

Route::get('/apartments/{apartment}', function (Apartment $apartment) {
    $apartment->load('apartmentImages');
    return view('apartments.details', compact('apartment'));
})->name('apartments.details');

Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
    $settings = Setting::first();

    return view('pages.show', compact('page', 'settings'));
});