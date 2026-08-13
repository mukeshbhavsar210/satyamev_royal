<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Timeline;
use App\Models\Project;
use App\Models\Setting;

Route::get('/', function () {
    $gallery = \App\Models\Gallery::where('status', 1)->orderBy('sort_order')->get();
    $timelines = Timeline::where('status', 1)->orderBy('sort_order')->get();
    $floatingTips = Project::where('status', 1)->get();
    $projects = Project::where('status', 1)->take(10)->get();
    $settings = Setting::first();

    return view('home', compact('gallery', 'floatingTips', 'projects', 'timelines', 'settings'));
});

Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
    $settings = Setting::first();

    return view('pages.show', compact('page', 'settings'));
});