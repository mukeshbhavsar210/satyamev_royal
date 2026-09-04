@extends('layouts.app')

@section('content')

<main data-barba-namespace="contact" data-barba="container" class="transition-container">    
  <section data-bg="light" class="section clip">
    <div class="container">      
      <div class="lot-w">
        <div class="lot-s">
          <div class="lot-s_info">
            <div class="grid h-100">
              <div class="lot-s_info_c">
                <div class="lot-s_info_header is-top">
                  <div class="u-48"></div>
                  <div class="u-272 b-mob"></div>
                  <div class="lot-s_info_header_num">
                    <h3 class="h3">{{ $apartment->project->title }}</h3>
                  </div>
                  <div class="u-16"></div>
                  <h3 class="l2"><span>{{ $apartment->project->location }}</span></h3>
                  <div class="u-12"></div>
                  <h3 class="l2 reg"><span>{{ $apartment->project->rera }}</span></h3>
                </div>

                <div data-lenis-scroll="" class="lot-s_info_t scrollbar-none lenis">
                  <div class="u-64"></div>
                  <div class="lot-s_info_data">
                    <div class="data-item">
                      <h4 class="l1 reg">Bedrooms</h4>
                      <div class="u-16"></div>
                      <h6 class="h6">{{ $apartment->rooms }}</h6>
                    </div>
                    
                    <div class="data-item">
                      <h4 class="l1 reg">Size</h4>
                      <div class="u-16"></div>
                      <h6 class="h6">{{ $apartment->area }}</h6>
                    </div>

                    <div class="data-item">
                      <h4 class="l1 reg">Completion</h4>
                      <div class="u-16"></div>
                      <h6 class="h6">{{ \Carbon\Carbon::parse($apartment->project->completion)->format('F, Y') }}</h6>
                    </div>

                    <div data-tabs="" class="lot-s_info_more">
                      <div data-tabs-hilight="hor" class="tabs">
                        <div data-tab="" data-tab-trigger="desc" hover-tab="" class="tab is-active">
                          <div class="l1">Description</div>
                        </div>
                        <div data-tab="" data-tab-trigger="size" hover-tab="" class="tab">
                          <div class="l1">Size</div>
                        </div>
                        <div class="tabs_line">
                          <div class="line-h"></div>
                        </div>
                        <div data-tab-hilight="" class="tabs_hilight"></div>
                      </div>

                        <div class="lot-s_info_more_contents">
                          <div data-tab-content="desc" class="lot-s_info_more_content is-1 is-active">
                              <div class="u-16"></div>
                              <p data-tab="p" class="p1">{{ $apartment->description }}</p>
                              <div class="u-160 b-desk"></div>
                            </div>
                            
                              <div data-tab-content="size" class="lot-s_info_more_content">
                                <div class="u-16"></div>
                                <div class="benefits-tag-cms w-dyn-list">                                
                                  <div data-tab="p" role="listitem" class="benefits-tag-cms_list_item w-dyn-item">
                                    <p data-tab="p" class="p1">Size: {{ $apartment->area }}</p>
                                  </div>                                                      
                                </div>
                              </div>
                            </div>
                            <div class="u-160 b-desk"></div>
                          </div>
                        </div>
                      </div>

                  <div class="lot-s_info_b">
                    <div class="u-48 b-mob"></div>
                    <div class="u-16 b-desk"></div>
                    
                    <div class="btn-list">
                      <a data-modal-cta-btn="book-a-call" hover-btn="" hover-nav-item="" data-wf--btn--variant="sec" href="#" class="btn w-inline-block">
                        <div class="btn_label">
                          <div class="btn_label_text">
                            <div hover="text" class="l1">Submit a Request</div>
                          </div>
                          <div class="btn_label_text is-2">
                            <div hover="text" class="l1">Submit a Request</div>
                          </div>
                        </div>                      
                        <div class="btn_bg">
                          <div hover="bg" class="btn_bg_fill"></div>                        
                        </div>
                      </a>

                      @if($apartment->project?->pdf)
                        <a hover-btn="" hover-nav-item="" data-wf--btn--variant="sec-circle" href="{{ Storage::url($apartment->project->pdf) }}" download class="btn w-variant-9f3f61aa-a2e8-bef6-01f9-2f3463919d6d w-inline-block">
                          <div class="btn_label">
                            <div class="btn_label_text">
                              <div hover="text" class="l1">PDF</div>
                            </div>     
                            <div class="btn_label_text is-2">
                            <div hover="text" class="l1">PDF</div>
                          </div>                   
                          </div>
                          <div class="btn_bg">
                            <div hover="bg" class="btn_bg_fill"></div>
                          </div>
                        </a>
                      @endif
                    </div>
                    <div class="u-48"></div>
                  </div>
                <div class="lot-s_info_line is-top">
                  <div data-scroll-reveal="line" class="line-v" ></div>
                </div>
              </div>
            </div>
          </div>

          <div class="lot-s_media b-desk">
            <div class="grid">
              <div class="lot-s_media_c">
                <div class="lot-s_media_layout">
                  <div class="grid _5-columns">
                    <div class="lot-s_media_layout_img-prim theme_on-color">
                        @if($apartment->project->image)                            
                            <img src="{{ asset('storage/' . $apartment->project->image) }}" alt="{{ $apartment->project->title }}" class="img contain">
                        @endif                                            
                    </div>                    
                  </div>
                  <div class="u-48"></div>
                </div>

                <div class="lot-media-cms w-dyn-list">                  
                  <div class="lot-media-cms_list w-dyn-items">
                    @if($apartment->apartmentImages->count())
                        @foreach($apartment->apartmentImages as $apartmentImage)
                            <div role="listitem" class="lot-media-cms_list_item w-dyn-item w-dyn-repeater-item">
                                <img src="{{ asset('storage/' . $apartmentImage->image) }}" alt="{{ $apartment->project_name }}" class="img contain">                                
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

  <!-- @include('pages.apartments.showcase')   -->
</main>
@endsection