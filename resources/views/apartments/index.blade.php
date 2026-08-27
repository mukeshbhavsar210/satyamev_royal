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
                <h1 data-prevent-flicker="" data-scroll-reveal="h" class="h1 a-center mob_a-left" >
                  <span class="split-word" >
                    <span class="split-char"  >A</span>
                    <span class="split-char"  >p</span>
                    <span class="split-char"  >a</span>
                    <span class="split-char"  >r</span>
                    <span class="split-char"  >t</span>
                    <span class="split-char"  >m</span>
                    <span class="split-char"  >e</span>
                    <span class="split-char"  >n</span>
                    <span class="split-char"  >t</span>
                    <span class="split-char"  >s</span>                    
                  </span>
                </h1>
                <div data-prevent-flicker="" data-filter-count="" data-scroll-reveal="h" class="h1 a-right b-desk" >25</div>
              </div>
              <div class="u-16"></div>

              <div data-prevent-flicker="" data-scroll-reveal="ctn" class="apart-s_cms_filter" >
                <div class="apart-s_cms_filter_c">
                  <div class="grid _9-columns">
                      @include('apartments.filter1')
                      @include('apartments.filter2')
                      @include('apartments.filter3')
                      @include('apartments.filter4')
                  </div>
                </div>
              </div>              
              
              <div class="u-16 b-desk"></div>
              <div class="u-8 b-mob"></div>

              <div data-prevent-flicker="" data-scroll-reveal="ctn" class="apart-cms w-dyn-list">
                <div data-sort-list="" data-filter-list="" role="list" class="apart-cms_list w-dyn-items">
                
                @foreach($apartments as $apartment)
                  <div class="apart-cms_list_item w-dyn-item">
                    <a data-sort-relevant="1" hover-apart-card="" href="{{ route('apartments.details', $apartment->id) }}" class="apart-card w-inline-block">
                      <div class="apart-card_c">                                 
                        <div class="apart-card_b">
                          <div class="apart-card_info">
                            <h3 class="h5">{{ $apartment->apartment_name }}</h3>                             
                          </div>              
                          <div class="u-16"></div>            
                          <h2 class="l2 a-center">{{ $apartment->project?->project_name }}</h2>                          
                        </div>

                        <div class="apart-card_img">
                          <div class="apart-card_img_prim">
                            @if($apartment->image)
                                <img src="{{ asset('storage/' . $apartment->image) }}" loading="eager" alt="" sizes="100vw" alt="{{ $apartment->apartment_name }}" class="img contain">
                            @else
                                <span>No image</span>
                            @endif                           
                          </div>
                        </div>                        
                        
                        <div class="apart-card_t">
                          <h2 data-type="ground-floor-basement" class="l2 a-center">Ground floor + basement</h2>
                          <div class="u-4"></div>
                            <p id="" class="l2 reg a-center">
                              <span>Completion: </span>
                              <span>{{ \Carbon\Carbon::parse($apartment->completion)->format('F Y') }}</span>
                            </p>
                        </div>
                      </div>                      
                      <div hover="shadow" class="apart-card_shadow"></div>
                    </a>
                  </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="u-160"></div>
        </div>

        @include('layouts.header.right_flower_video')

        @include('apartments.arch')
    </div>
    </div>
  </section>

  <section data-bg="color" class="section theme_on-color">
    <div data-footer-clip="" class="container" >
      <div class="cta-w">
        <div class="cta-s">
         
          <div class="grid">
            <div class="cta-s_title">
              <h2 data-scroll-reveal="h" class="h1 a-center">
                <span class="split-word" >
                  <span class="split-char"  >P</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >r</span>
                  <span class="split-char"  >f</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >c</span>
                  <span class="split-char"  >t</span>
                </span>
                <br>
                <span class="split-word" >
                  <span class="split-char"  >s</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >a</span>
                </span>
                <span class="split-word" >
                  <span class="split-char"  >v</span>
                  <span class="split-char"  >i</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >w</span>
                  <span class="split-char"  >s</span>
                </span>
              </h2>
              <div class="u-32"></div>
              <h3 data-scroll-reveal="h" class="c1 a-center">
                <span class="split-word" >
                  <span class="split-char"  >F</span>
                  <span class="split-char"  >r</span>
                  <span class="split-char"  >o</span>
                  <span class="split-char"  >m</span>
                </span>
                <span class="split-word" >
                  <span class="split-char"  >r</span>
                  <span class="split-char"  >o</span>
                  <span class="split-char"  >o</span>
                  <span class="split-char"  >f</span>
                  <span class="split-char"  >t</span>
                  <span class="split-char"  >o</span>
                  <span class="split-char"  >p</span>
                </span>
                <span class="split-word" >
                  <span class="split-char"  >t</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >r</span>
                  <span class="split-char"  >r</span>
                  <span class="split-char"  >a</span>
                  <span class="split-char"  >c</span>
                  <span class="split-char"  >e</span>
                  <span class="split-char"  >s</span>
                </span>
              </h3>
              <div class="u-160"></div>
              <div data-scroll-reveal="ctn" class="cta-s_title_btn" >
                <div hover-btn-circle="" data-magnetic-btn="" hover-nav-item-trigger="" class="btn-circle">
                  <div data-magnetic-inner="" class="btn-circle_label">
                    <a hover-nav-item="" href="/apartments" aria-current="page" class="nav-item w-inline-block w--current">
                      <div class="nav-item_label">
                        <div class="nav-item_label_text">
                          <div hover="text" class="l1" >
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char" >V</span>
                                <span class="split-char" >i</span>
                                <span class="split-char" >e</span>
                                <span class="split-char" >w</span>
                              </span>
                            </span>
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char" >a</span>
                                <span class="split-char" >v</span>
                                <span class="split-char" >a</span>
                                <span class="split-char" >i</span>
                                <span class="split-char" >l</span>
                                <span class="split-char" >a</span>
                                <span class="split-char" >b</span>
                                <span class="split-char" >l</span>
                                <span class="split-char" >e</span>
                              </span>
                            </span>
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char" >a</span>
                                <span class="split-char" >p</span>
                                <span class="split-char" >a</span>
                                <span class="split-char" >r</span>
                                <span class="split-char" >t</span>
                                <span class="split-char" >m</span>
                                <span class="split-char" >e</span>
                                <span class="split-char" >n</span>
                                <span class="split-char" >t</span>
                                <span class="split-char" >s</span>
                              </span>
                            </span>
                          </div>
                        </div>
                        <div class="nav-item_label_text is-2">
                          <div hover="text" class="l1" >
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char"  >V</span>
                                <span class="split-char"  >i</span>
                                <span class="split-char"  >e</span>
                                <span class="split-char"  >w</span>
                              </span>
                            </span>
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char"  >a</span>
                                <span class="split-char"  >v</span>
                                <span class="split-char"  >a</span>
                                <span class="split-char"  >i</span>
                                <span class="split-char"  >l</span>
                                <span class="split-char"  >a</span>
                                <span class="split-char"  >b</span>
                                <span class="split-char"  >l</span>
                                <span class="split-char"  >e</span>
                              </span>
                            </span>
                            <span class="split-word-mask"  >
                              <span class="split-word" >
                                <span class="split-char"  >a</span>
                                <span class="split-char"  >p</span>
                                <span class="split-char"  >a</span>
                                <span class="split-char"  >r</span>
                                <span class="split-char"  >t</span>
                                <span class="split-char"  >m</span>
                                <span class="split-char"  >e</span>
                                <span class="split-char"  >n</span>
                                <span class="split-char"  >t</span>
                                <span class="split-char"  >s</span>
                              </span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="btn-circle_bg w-embed">
                    <svg data-circle="" viewBox="0 0 208 208" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                      <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(-150 104 104)" ></circle>
                      <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(30 104 104)" ></circle>
                      <circle cx="104" cy="104" r="103.5" stroke="var(--_colors---base-1000--line)" stroke-width="1" fill="none"></circle>
                    </svg>
                  </div>
                  <a href="/apartments" aria-current="page" class="btn-circle_link w-inline-block w--current"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w_bg">
          <div data-parallax="w" class="img-w">
            <img data-parallax="img" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2.webp" sizes="(max-width: 1920px) 100vw, 1920px" srcset="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2-p-500.png 500w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2-p-800.png 800w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2-p-1080.png 1080w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2-p-1600.png 1600w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a1571e51d50c8bcf5f4bb3d_era-residence-garden-2.webp 1920w" class="img-p" >
            <div class="img-over-grad from-top _4x"></div>
            <div class="img-over-grad"></div>
            <div class="img-over-grad"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
</main>
    
@endsection