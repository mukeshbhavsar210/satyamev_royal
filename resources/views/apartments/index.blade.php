@extends('layouts.app')

@section('content')

<main data-barba-namespace="contact" data-barba="container" class="transition-container">
  <section class="section clip">    
    <div class="container">
      <div class="apart-w">
        <div class="apart-s">
          <div class="u-48"></div>
          <div class="u-272"></div>
          <div class="grid">
            <div data-sort="" data-filter="" class="apart-s_cms">
              <div class="apart-s_title">
                <h2>Apartments</h2>
                <h3>{{ $apartments->count() }}</h3>
              </div>
              <div class="u-16"></div>

              <div class="apart-s_cms_filter" >
                <div class="apart-s_cms_filter_c">
                  <div class="grid _9-columns">
                    @php
                      $filters = [
                          'status' => [
                              'title' => 'Status',
                              'items' => [
                                  '' => 'All',
                                  'ongoing' => 'Ongoing',
                                  'completed' => 'Completed',
                                  'upcoming' => 'Upcoming',
                              ],
                          ],

                          'bed' => [
                              'title' => 'Bedrooms',
                              'items' => [
                                  '' => 'All',                                  
                                  '2' => '2',
                                  '3' => '3',
                                  '4' => '4',
                              ],
                          ],

                          'sort_by' => [
                              'title' => 'Sort By',
                              'items' => [
                                  'relevant' => 'Relevant',
                                  'smallest_area' => 'Smallest Area',
                                  'largest_area' => 'Largest Area',
                              ],
                          ],
                      ];
                  @endphp

                  @foreach ($filters as $filterKey => $filter)
                    @php
                        $currentValue = request($filterKey);
                        $currentLabel = $filter['items'][$currentValue ?? ''] ?? $filter['title'];
                    @endphp

                    <div class="apart-s_cms_filter_item {{ $loop->last ? 'is-last' : '' }}">
                        <div data-select="" class="filter_select">
                            <div data-select="btn" class="filter_select_btn">
                                <div class="l2 reg">{{ $filter['title'] }}</div>
                                <div class="filter_select_btn_label apartment-filter-dropdown">
                                    <div class="filter-dropdown-menu filter_select_drop-down">
                                        <div class="filter_select_drop-down_list">
                                            <div class="cms w-dyn-list">
                                                <div class="filter_select_drop-down_list w-dyn-items">
                                                    @foreach ($filter['items'] as $value => $label)
                                                        <div class="cms_list_item w-dyn-item">
                                                            <div class="filter_select_drop-down_list_item no-padd">
                                                                <div class="l1">
                                                                    <a href="/apartments?{{ $filterKey }}={{ $value }}"
                                                                      data-filter="{{ $filterKey }}" data-value="{{ $value }}"
                                                                      class="nav-item w-inline-block {{ $currentValue == $value ? 'is-active' : '' }}">
                                                                        {{ $label }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Selected value --}}
                                    <a hover-nav-item-l2="" href="#" class="filter-dropdown-toggle nav-item w-inline-block">
                                        <div class="nav-item_label">
                                            <div hover="text" class="nav-item_label_text">
                                                <div data-select="value" class="l2">
                                                    <span class="selected-filter">{{ $currentLabel }}</span>
                                                </div>
                                            </div>
                                            <div hover="text" class="nav-item_label_text is-2">
                                                <div data-select="value" class="l2">
                                                    <span class="selected-filter">{{ $currentLabel }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div hover="ico" class="ico-12">
                                            <div class="ico w-embed">
                                                <svg width="100%"
                                                    height="100%"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">

                                                    <path d="M17.1166 8.11436C17.6048 7.62682 18.3982 7.62641 18.8862 8.11436C19.3741 8.60232 19.3737 9.39569 18.8862 9.88389L12.8862 15.8839C12.398 16.372 11.6048 16.372 11.1166 15.8839L5.11662 9.88389C4.62846 9.39574 4.62846 8.60252 5.11662 8.11436C5.60483 7.62682 6.3982 7.62641 6.88615 8.11436L12.0014 13.2296L17.1166 8.11436Z"
                                                          fill="currentColor">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($loop->last)
                            <a href="/apartments" class="reset-filters nav-item w-inline-block">
                              <div class="nav-item_label">
                                  <div hover="text" class="nav-item_label_text">
                                      <div class="l2">Reset</div>
                                  </div>
                                  <div hover="text" class="nav-item_label_text is-2">
                                      <div class="l2">Reset</div>
                                  </div>
                              </div>
                          </a>
                        @endif
                    </div>
                @endforeach
              </div>
          </div>

            <div class="apart-s_cms_decor">
                <div data-wf--decor--variant="med" class="decor">
                    <div class="frame_l-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                    </div>
                    <div class="frame_lt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                    </div>
                    <div class="frame_t-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                        </div>
                        <div class="frame_rt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                        </div>
                        <div class="frame_r-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                        </div>
                        <div class="frame_rb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                    </div>
                    <div class="frame_b-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                    </div>
                    <div class="frame_lb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                        </svg>
                    </div>
                  </div>
                </div>
              </div>              
                
                <div class="u-16 b-desk"></div>
                <div class="u-8 b-mob"></div>
                
                <div class="apart-cms w-dyn-list">
                  <div class="apart-cms_list w-dyn-items" id="apartments-list">                  
                      @include('apartments.list', ['apartments' => $apartments])                  
                  </div>
                </div>
              </div>
            </div>
            <div class="u-160"></div>
          </div>
          <div data-video-playpause="" data-parallax="ctn-down" class="flower apart" >
            @include('parts.flowers.flower_rt')
        </div>
      </div>
    </div>
  </section>
</main>
    
@endsection