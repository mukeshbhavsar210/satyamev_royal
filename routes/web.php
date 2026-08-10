<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Timeline;


Route::get('/', function () {
    $gallery = \App\Models\Gallery::where('status', 1)->orderBy('sort_order')->get();
    $timelines = Timeline::where('status', 1)->orderBy('sort_order')->get();

    return view('home', compact('gallery', 'timelines'));
});


Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();
    return view('pages.show', compact('page'));
});
