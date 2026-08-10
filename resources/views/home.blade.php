@extends('layouts.app')

@section('content')
<div data-barba="wrapper" class="transition-wrapper">
        @include('layouts.header.body_style')

        <div class="landscape-cover">
            <div class="landscape-cover_img">
                <img loading="eager" src="assets/images/preloader/landscape.svg" alt="" class="img contain">
            </div>
            <div class="landscape-cover_bg"></div>
        </div>

        @include('layouts.header.preloader')
        @include('layouts.header.cookies')
        
        <main data-barba-namespace="home" data-barba="container" class="transition-container">
            <div class="theme_on-color">

                @include('layouts.header.logo')  
                              
                <div data-theme="" class="header-nav theme_on-color">
                    <div class="header-nav_list f-mob">
                        <div hover-nav-item-l2-trigger="" data-modal-menu-btn="mob" class="btn-menu">
                            <div class="btn-menu_label is-active">
                                <a hover-nav-item-l2="" aria-label="Menu" href="#" class="nav-item w-inline-block">
                                    <div class="nav-item_label">
                                        <div hover="text" class="nav-item_label_text">
                                            <div class="l2">Menu</div>
                                        </div>
                                        <div hover="text" class="nav-item_label_text is-2">
                                            <div class="l2">Menu</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="btn-menu_label">
                                <a hover-nav-item-l2="" aria-label="Close" href="#" class="nav-item w-inline-block">
                                    <div class="nav-item_label">
                                        <div hover="text" class="nav-item_label_text">
                                            <div class="l2">Close</div>
                                        </div>
                                        <div hover="text" class="nav-item_label_text is-2">
                                            <div class="l2">Close</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="ico-24">
                                <div class="ico">
                                    <div data-ico-menu="is-1" class="ico w-embed" style="translate: none; rotate: none; scale: none; transform: rotate(180deg);">
                                        <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5 19C13.5 19.8284 12.8284 20.5 12 20.5C11.1716 20.5 10.5 19.8284 10.5 19C10.5 18.1716 11.1716 17.5 12 17.5C12.8284 17.5 13.5 18.1716 13.5 19Z" fill="currentColor"></path>
                                            <path d="M13.5 12C13.5 12.8284 12.8284 13.5 12 13.5C11.1716 13.5 10.5 12.8284 10.5 12C10.5 11.1716 11.1716 10.5 12 10.5C12.8284 10.5 13.5 11.1716 13.5 12Z" fill="currentColor"></path>
                                            <path d="M13.5 5C13.5 5.82843 12.8284 6.5 12 6.5C11.1716 6.5 10.5 5.82843 10.5 5C10.5 4.17157 11.1716 3.5 12 3.5C12.8284 3.5 13.5 4.17157 13.5 5Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div data-ico-menu="is-2" class="ico ia-2 w-embed" style="translate: none; rotate: none; scale: none; transform: rotate(180deg);">
                                        <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5 19C13.5 19.8284 12.8284 20.5 12 20.5C11.1716 20.5 10.5 19.8284 10.5 19C10.5 18.1716 11.1716 17.5 12 17.5C12.8284 17.5 13.5 18.1716 13.5 19Z" fill="currentColor"></path>
                                            <path d="M13.5 12C13.5 12.8284 12.8284 13.5 12 13.5C11.1716 13.5 10.5 12.8284 10.5 12C10.5 11.1716 11.1716 10.5 12 10.5C12.8284 10.5 13.5 11.1716 13.5 12Z" fill="currentColor"></path>
                                            <path d="M13.5 5C13.5 5.82843 12.8284 6.5 12 6.5C11.1716 6.5 10.5 5.82843 10.5 5C10.5 4.17157 11.1716 3.5 12 3.5C12.8284 3.5 13.5 4.17157 13.5 5Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('layouts.header.book_modal')                    
                </div>
                
                <div data-theme="" class="s-bar-w theme_on-color">
                    <div data-s-bar="" class="s-bar">
                        <div data-s-bar-thumb="" class="s-bar_thumb">
                            <div data-s-bar-label="" class="l1 a-center">00</div>
                        </div>
                        <div data-s-bar-fill="" class="s-bar_fill"></div>
                        <div data-s-bar-track="" class="s-bar_track"></div>
                    </div>
                </div>
                <div data-theme="" class="s-down theme_on-color" style="opacity: 1;">
                    <div class="s-down_arrow w-embed">
                        <svg width="100%" height="100%" viewBox="0 0 48 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.36533 3C7.10389 3.54701 6.85117 4.02564 6.60716 4.4359C6.34572 4.84615 6.09299 5.18804 5.84899 5.46154L45 5.46154L45 6.53846L5.84899 6.53846C6.09299 6.82906 6.34572 7.17949 6.60716 7.58974C6.85117 8 7.10389 8.47009 7.36533 9L6.45029 9C5.35226 7.75214 4.20193 6.82906 2.99932 6.23077L2.99932 5.76923C4.20193 5.18804 5.35226 4.26496 6.45029 3L7.36533 3Z"
                            fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="l2">Scroll</div>
                </div>
            </div>

            @include('layouts.header.hero')
            @include('parts.gallery')
            @include('parts.timeline')
            @include('parts.why')
            {{-- @include('parts.contact') 
            @include('parts.modal')
            @include('parts.floating')   --}}

            
        <div class="timeline-list">
            @foreach($timelines as $timeline)
                <div class="timeline-item">
                    <div class="timeline-year">
                        {{ $timeline->year }}
                    </div>
                    <div class="timeline-content">
                        @if($timeline->image)
                            <div class="timeline-image">
                                <img src="{{ Storage::url($timeline->image) }}" alt="{{ $timeline->title }}" >
                            </div>
                        @endif
                        <h3>{{ $timeline->title }}</h3>
                        <div class="timeline-description">
                            {!! $timeline->description !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
    </main>
@endsection