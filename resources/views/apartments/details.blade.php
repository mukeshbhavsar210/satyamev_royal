@extends('layouts.app')

@section('content')

<main data-barba-namespace="contact" data-barba="container" class="transition-container">    
  <section data-bg="light" class="section clip">
    <div class="container">
      @include('layouts.header.flower_video')
      <div class="lot-w">
        <div class="lot-s">
          <div class="lot-s_info">
            <div class="grid h-100">
              <div class="lot-s_info_c">
                <div class="lot-s_info_header is-top">
                  <div class="u-48"></div>
                  <div class="u-272 b-mob"></div>
                  <div class="lot-s_info_header_num">
                    <h1 class="h3">{{ $apartment->apartment_name }}</h1>                    
                  </div>
                  <!-- <div class="u-16"></div>
                  <h2 class="l2">Project Name: {{ $apartment->project?->project_name }}</h2> -->
                  <div class="u-16"></div>
                  <h3 class="l2">
                    <span>Address: {{ $apartment->location }}</span>
                  </h3>
                  <div class="u-16"></div>
                </div>
                <div data-lenis-scroll="" class="lot-s_info_t scrollbar-none lenis">
                  <div class="u-64"></div>
                  <div class="lot-s_info_data">
                    <div class="data-item">
                      <h4 class="l1 reg">Completion</h4>
                      <div class="u-8"></div>
                      <h6 class="h6">{{ $apartment->completion }}</h6>
                    </div>

                    <div class="data-item">
                      <h4 class="l1 reg">Bedrooms</h4>
                      <div class="u-8"></div>
                      <h6 class="h6">{{ $apartment->rooms }}</h6>
                    </div>

                    <div class="data-item">
                      <h4 class="l1 reg">Area</h4>
                      <div class="u-8"></div>
                      <h6 class="h6">{{ $apartment->area }}</h6>
                    </div>

                    <div class="data-item">
                      <h4 class="l1 reg">Descriptions</h4>
                      <div class="u-8"></div>
                      <h6 class="h6">{{ $apartment->description }}</h6>
                    </div>
                  </div>                  
                </div>

                <div class="lot-s_info_b">
                  <div class="u-48 b-mob"></div>
                  <div class="u-16 b-desk"></div>
                  <div class="btn-list">
                    <a data-modal-cta-btn="book-a-call" hover-btn="" hover-nav-item="" aria-label="Submit a request" data-wf--btn--variant="sec" href="#" class="btn w-inline-block">
                      <div class="btn_label">
                        <div class="btn_label_text">
                          <div hover="text" class="l1" aria-label="Submit a request">Submit a Request</div>
                        </div>                       
                      </div>
                      <div class="btn_bg">
                        <div hover="bg" class="btn_bg_fill"></div>
                      </div>
                    </a>
                    <a aria-label="pdf" hover-btn="" hover-nav-item="" data-wf--btn--variant="sec-circle" href="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a3526a9f0bb965967883ea1_011apt_compressed.pdf" class="btn w-variant-9f3f61aa-a2e8-bef6-01f9-2f3463919d6d w-inline-block">
                      <div class="btn_label">
                        <div class="btn_label_text">
                          <div hover="text" class="l1" aria-label="pdf">PDF</div>
                        </div>                        
                      </div>
                      <div class="btn_bg">
                        <div hover="bg" class="btn_bg_fill"></div>
                      </div>
                    </a>
                  </div>
                  <div class="u-48"></div>
                </div>
                <div class="lot-s_info_line is-top">
                  <div data-scroll-reveal="line" class="line-v" style="visibility: visible; clip-path: inset(0%);"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="lot-s_media b-desk">
            <div class="grid">
              <div class="lot-s_media_c">
                <div class="lot-s_media_layout">
                  <div class="grid _5-columns">
                    <div hover-pin-trigger="" hover-media-item="" class="lot-s_media_layout_img-prim theme_on-color">
                        @if($apartment->image)                            
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->project_name }}" class="img contain">
                        @endif                                            
                    </div>                    
                  </div>
                  <div class="u-48"></div>
                </div>

                <div class="lot-media-cms w-dyn-list">                  
                  <div role="list" class="lot-media-cms_list w-dyn-items">
                    @if($apartment->apartmentImages->count())
                        @foreach($apartment->apartmentImages as $apartmentImage)
                            <div role="listitem" class="lot-media-cms_list_item w-dyn-item w-dyn-repeater-item">
                                    <div class="lot-media-item theme_on-color">
                                        <div class="img-w h-auto">                                        
                                            <img src="{{ asset('storage/' . $apartmentImage->image) }}" alt="{{ $apartment->project_name }}" class="img h-auto">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        @endforeach                    
                    @endif                                    
                  </div>
                  <div class="cms_empty-none w-dyn-hide w-dyn-empty"></div>
                </div>
                <div class="u-48"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('apartments.showcase')

    <div class="hero_themes">
      <div data-bg="color" class="hero_themes_color"></div>
      <div data-bg="light" class="hero_themes_light"></div>
    </div>
  </div>

  @include('apartments.arch')

  <section data-bg="light" class="section z-2 clip">
    <div class="container">
      <div class="other-w">
        <div class="grid">
          <div class="other-s">
            <div class="u-48"></div>
            <div class="other-s_cms">
              <div data-prevent-flicker="" data-scroll-reveal="ctn" class="apart-cms w-dyn-list" >
                <div data-sort-list="" data-filter-list="" role="list" class="apart-benefits-cms_list c-2 w-dyn-items">
                  <div data-sort-item="" data-filter-item="" role="listitem" class="apart-cms_list_item w-dyn-item">
                    <a data-sort-relevant="4" hover-apart-card="" href="/apartments/032" class="apart-card w-inline-block">
                      <div class="apart-card_c">
                        <div class="apart-card_t">
                          <h2 data-type="ground-floor-basement" class="l2 a-center">Ground floor + basement</h2>
                          <div class="u-4"></div>
                          <p id="" class="l2 reg a-center">
                            <span>Completion: </span>
                            <span>4Q 2026</span>
                          </p>
                        </div>

                        <div class="u-16"></div>

                        <div class="apart-card_img">
                          <div class="apart-card_img_prim">

                          

                            <img src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32.webp" loading="eager" alt="" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32-p-500.webp 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32-p-800.webp 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32-p-1080.webp 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32-p-1600.webp 1600w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32-p-2000.webp 2000w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a345dedc369de219bae7b17_6a345c76c1fcff139914bf10_32.webp 2350w" class="img contain">
                          </div>
                        </div>

                        <div class="u-16"></div>
                        <div class="apart-card_b">
                          <div class="apart-card_data-list">
                            <p id="" class="l2 reg a-center">
                              <span>№</span>
                              <span>032</span>
                            </p>
                            <div class="data-divider"></div>
                            <p id="" class="l2 reg a-center">
                              <span>Block </span>
                              <span>B3</span>
                            </p>
                            <div class="data-divider"></div>
                            <p id="" class="l2 reg a-center">
                              <span>0</span>
                              <span>&nbsp;floor</span>
                            </p>
                          </div>
                          <div class="u-16"></div>
                          <div class="apart-card_info">
                            <h3 id="" data-bed="3" class="h5">
                              <span>3</span>
                              <span>&nbsp;bed</span>
                            </h3>
                            <div class="h5">/</div>
                            <h4 class="h5">
                              <span>134 m²</span>
                            </h4>
                          </div>
                          <div class="u-16"></div>
                          <div class="apart-card_add">
                            <h5 id="" class="l1 a-center">                              
                              <span>Terrace</span>
                            </h5>
                          </div>
                        </div>
                      </div>                                            
                      <div hover="shadow" class="apart-card_shadow"></div>
                    </a>
                  </div>                  
                </div>
              </div>
            </div>

            <div class="u-32"></div>

            <div class="btn-list center">
              <a aria-label="View all" hover-btn="" hover-nav-item="" data-wf--btn--variant="sec" href="/apartments" class="btn w-inline-block">
                <div class="btn_label">
                  <div class="btn_label_text">
                    <div hover="text" class="l1" aria-label="View all">View All</div>
                  </div>                  
                </div>
                <div class="btn_bg">
                  <div hover="bg" class="btn_bg_fill"></div>
                </div>
              </a>
            </div>
            <div class="u-48"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection