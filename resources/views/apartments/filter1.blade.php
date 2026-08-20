@php
    $selectedFilter = array_key_first(request()->query());
@endphp

<div class="apart-s_cms_filter_item">
    <div data-select="" class="filter_select">
        <div data-select="btn" class="filter_select_btn">
            <div class="l2 reg">Status</div>
            <div class="filter_select_btn_label">
                <a hover-nav-item-l2="" aria-label="All" href="#" class="nav-item w-inline-block">
                    <div class="nav-item_label">
                        <div hover="text" class="nav-item_label_text">
                            
                            <div data-select="value" class="l2">{{ $selectedFilter ? ucfirst($selectedFilter) : 'All' }}</div>
                        </div>
                        <div hover="text" class="nav-item_label_text is-2">
                            <div data-select="value" class="l2">{{ $selectedFilter ? ucfirst($selectedFilter) : 'All' }}</div>
                        </div>
                    </div>
                </a>
                <div hover="ico" class="ico-12">
                    <div class="ico w-embed">
                        <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.1166 8.11436C17.6048 7.62682 18.3982 7.62641 18.8862 8.11436C19.3741 8.60232 19.3737 9.39569 18.8862 9.88389L12.8862 15.8839C12.398 16.372 11.6048 16.372 11.1166 15.8839L5.11662 9.88389C4.62846 9.39574 4.62846 8.60252 5.11662 8.11436C5.60483 7.62682 6.3982 7.62641 6.88615 8.11436L12.0014 13.2296L17.1166 8.11436Z" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div data-select="drop-down" class="filter_select_drop-down">
            <div class="filter_select_drop-down_list">                
                <div class="cms w-dyn-list">
                    <div role="list" class="filter_select_drop-down_list w-dyn-items">
                        <div role="listitem" class="cms_list_item w-dyn-item">
                            <div class="filter_select_drop-down_list_item">
                                <a href="{{ url('/projects') }}" >
                                    <div hover="text" class="l1">All</div>
                                </a>
                            </div>
                        </div>

                        {{-- Ongoing --}}
                        <div role="listitem" class="cms_list_item w-dyn-item">
                            <div class="filter_select_drop-down_list_item">
                                <a href="{{ url('/projects?ongoing') }}" class="{{ $selectedFilter === 'ongoing' ? 'active' : '' }}">
                                    <div hover="text" class="l1">Ongoing</div>
                                </a>
                            </div>
                        </div>

                        {{-- Upcoming --}}
                        <div role="listitem" class="cms_list_item w-dyn-item">
                            <div class="filter_select_drop-down_list_item">
                                <a href="{{ url('/projects?upcoming') }}" class="{{ $selectedFilter === 'upcoming' ? 'active' : '' }}">
                                    <div hover="text" class="l1">Upcoming</div>
                                </a>
                            </div>
                        </div>

                        {{-- Completed --}}
                        <div role="listitem" class="cms_list_item w-dyn-item">
                            <div class="filter_select_drop-down_list_item">
                                <a href="{{ url('/projects?completed') }}" class="{{ $selectedFilter === 'completed' ? 'active' : '' }}">
                                    <div hover="text" class="l1">Completed</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>