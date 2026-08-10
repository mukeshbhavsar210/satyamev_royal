@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <div class="container">
        <h1>{{ $page->title }}</h1>
        <div class="page-content">            
            {{ $page->featured_image }}

          @if($page->featured_image)
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($page->featured_image) }}"
                    alt="{{ $page->title }}"
                >
            @endif

            <img
                src="{{ Storage::url($page->featured_image) }}"
                alt="{{ $page->title }}"
            >
            
            {!! $page->content !!}
        </div>
    </div>
@endsection