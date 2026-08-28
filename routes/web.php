<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Timeline;
use App\Models\Project;
use App\Models\Apartment;
use App\Models\Setting;
use App\Models\Slide;

Route::get('/', function () {
    $timelines = Timeline::orderBy('sort_order')->get();
    $floatingTips = Apartment::where('status', 1)->get();
    $apartments = Apartment::where('status', 1)->where('category', 'ongoing')->take(5)->get();

    return view('home.index', compact('floatingTips', 'apartments', 'timelines'));
})->name('home');


Route::get('/apartments', function () {
    $query = Apartment::query();
    $allowedStatuses = ['ongoing','completed','upcoming',];
    $selectedStatus = request('status');

    if (in_array($selectedStatus, $allowedStatuses)) {
        $query->where('category', $selectedStatus);
    }

    // Bedroom filter
    $selectedBedroom = request('bed');
    if (request()->filled('bed')) {
        $query->where('rooms', $selectedBedroom);
    }

    $selectedSort = request('sort_by');
    match ($selectedSort) {
        'smallest_area' => $query->orderBy('area', 'asc'),
        'largest_area'  => $query->orderBy('area', 'desc'),
        default         => $query,
    };

    $apartments = $query->get();

    $floatingTips = Apartment::select('category')->distinct()->get();

    if (request()->ajax()) {
        return view('apartments.list', compact('apartments'))->render();
    }

    return view('apartments.index', compact('apartments','floatingTips','selectedStatus','selectedBedroom','selectedSort'));
})->name('apartments');


Route::get('/apartments/{apartment}', function (Apartment $apartment) {
    $apartment->load('apartmentImages');

    return view('apartments.details', compact('apartment'));
})->name('apartments.details');


Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
    $settings = Setting::first();

    return view('pages.show', compact('page', 'settings'));
});