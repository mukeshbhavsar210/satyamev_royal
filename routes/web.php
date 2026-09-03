<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Timeline;
use App\Models\Project;
use App\Models\Apartment;
use App\Models\Setting;
use App\Models\Slide;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    $timelines = Timeline::orderBy('sort_order')->get();        
    $floatingTips = Project::where('show', 'yes')->whereIn('category', ['ongoing', 'upcoming', 'completed'])->take(12)->get();
    $projects = Project::where('show', 'yes')->where('category', 'ongoing')->take(5)->get();    

    return view('pages.home', compact('floatingTips', 'projects', 'timelines'));
})->name('home');


Route::get('/contact', function () {
    $contact = Setting::first();
    return view('pages.contact', compact('contact'));
})->name('contact');


Route::get('/apartments', function () {

    $query = Apartment::with('project')
        ->where('show', 'yes');

    // Status / Project Category filter
    $allowedStatuses = ['ongoing', 'completed', 'upcoming'];
    $selectedStatus = request('status');

    if (in_array($selectedStatus, $allowedStatuses)) {
        $query->whereHas('project', function ($q) use ($selectedStatus) {
            $q->where('category', $selectedStatus);
        });
    }

    // Bedroom filter
    $selectedBedroom = request('bed');

    if (request()->filled('bed')) {
        $query->where('rooms', $selectedBedroom);
    }

    // Sort
    $selectedSort = request('sort_by');

    match ($selectedSort) {
        'smallest_area' => $query->orderBy('area', 'asc'),
        'largest_area'  => $query->orderBy('area', 'desc'),
        default         => $query,
    };

    $apartments = $query->get();

    // Get categories from Projects table
    $floatingTips = \App\Models\Project::select('category')
        ->whereNotNull('category')
        ->whereIn('category', $allowedStatuses)
        ->distinct()
        ->get();

    if (request()->ajax()) {
        return view('apartments.list', compact('apartments'))->render();
    }

    return view('pages.apartments.index', compact(
        'apartments',
        'floatingTips',
        'selectedStatus',
        'selectedBedroom',
        'selectedSort'
    ));
})->name('apartments');

Route::get('/apartments/{apartment}', function (Apartment $apartment) {
    $apartment->load('apartmentImages');

    return view('pages.apartments.details', compact('apartment'));
})->name('apartments.details');


Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
    $settings = Setting::first();

    return view('pages.page', compact('page', 'settings'));
})->name('pages');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::redirect('/admin', '/admin/configuration');