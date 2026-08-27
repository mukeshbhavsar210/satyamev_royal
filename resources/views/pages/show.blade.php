@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<main data-barba-namespace="contact" data-barba="container" class="transition-container">    
    <section class="section clip">
        <div class="container">
            <div class="apart-w">
                <div class="apart-s">
                    <div class="u-24"></div>
                    <div class="u-272"></div>
                    <div class="grid">
                        <div data-sort="" data-filter="" class="apart-s_cms">
                            <div class="apart-s_title">
                                <h1 data-prevent-flicker="" data-scroll-reveal="h" class="h1 a-center mob_a-left">
                                    {{ $page->title }}
                                </h1>                                
                            </div>
                        </div>
                    </div>                 
                </div>
                <div data-video-playpause="" data-parallax="ctn-down" class="flower apart" >
                    @include('parts.flowers.flower_rt')                    
                </div>
            </div>
        </div>
        <div class="u-64"></div>
    </section>

    <section data-bg="color" class="section theme_on-color">
        <div data-footer-clip="" class="container">
            <div class="cta-w">
                <div class="cta-s">
                    <div class="u-48"></div>                    
                    <div class="u-272"></div>
                    <div class="grid">
                        <div class="cta-s_title">
                            <h2 data-scroll-reveal="h" class="h1 a-center">Second title</h2>
                            <div class="u-32"></div>
                            <h3 data-scroll-reveal="h" class="c1 a-center">Third Title</h3>
                            <div class="u-160"></div>
                            <div data-scroll-reveal="ctn" class="cta-s_title_btn" >
                                <div hover-btn-circle="" data-magnetic-btn="" hover-nav-item-trigger="" class="btn-circle">
                                    <div data-magnetic-inner="" class="btn-circle_label">
                                        <a hover-nav-item=""  href="/apartments" aria-current="page" class="nav-item w-inline-block w--current">
                                            <div class="nav-item_label">
                                                <div class="nav-item_label_text">
                                                    <div hover="text" class="l1" >
                                                      View Apartments</div>
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
                                    <a  href="/apartments" aria-current="page" class="btn-circle_link w-inline-block w--current"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w_bg">
                    <div data-parallax="w" class="img-w">
                        @if($page->featured_image)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($page->featured_image) }}" alt="{{ $page->title }}" loading="eager" alt="Showcase" sizes="(max-width: 1920px) 100vw, 1920px" class="img-p">
                        @endif
                        <div class="img-over-grad from-top _4x"></div>
                        <div class="img-over-grad"></div>
                        <div class="img-over-grad"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>                                                 
@php
    $pageImages = $page->images ?? collect();
@endphp

@if ($pageImages->isNotEmpty())
    @foreach ($pageImages as $pageImage)
        @php
            $filename = pathinfo($pageImage->image, PATHINFO_FILENAME);

            // Remove size suffix: -500, -800, -1080, etc.
            $baseName = preg_replace('/-\d+$/', '', $filename);

            $directory = dirname($pageImage->image);
            $extension = pathinfo($pageImage->image, PATHINFO_EXTENSION);

            $sizes = [500, 800, 1080, 1600, 1920];

            $srcset = [];

            foreach ($sizes as $size) {

                $sizeFile = "{$baseName}-{$size}.{$extension}";
                $sizePath = "{$directory}/{$sizeFile}";

                if (Storage::disk('public')->exists($sizePath)) {
                    $srcset[] = Storage::url($sizePath) . " {$size}w";
                }
            }

            // Prefer 1920, then 1600, etc.
            $mainImage = null;

            foreach ([1920, 1600, 1080, 800, 500] as $size) {

                $sizeFile = "{$baseName}-{$size}.{$extension}";
                $sizePath = "{$directory}/{$sizeFile}";

                if (Storage::disk('public')->exists($sizePath)) {
                    $mainImage = $sizePath;
                    break;
                }
            }

            // Generate div1, div2, div3...
            $divClass = 'div' . $loop->iteration;
        @endphp

        @if ($mainImage)
            <div class="{{ $divClass }}">
                <div class="amen-scroll-area">
                  <div class="scroll-area_screen">
                    <section class="section clip theme_on-color">
                      <div class="container">
                        <div class="amen-w" >
                          <div class="amen-s">
                            <div data-tabs-hilight="ver" data-tabs="" class="amen-s_cms">
                              <div class="amen-cms w-dyn-list" >
                                <div role="list" class="amen-cms_list w-dyn-items">
                                  <div data-reveal-first="" data-tab-content="gated-community" role="listitem" class="amen-cms_list_item w-dyn-item is-active">
                                    <div data-parallax="w" class="amen-slide">                        
                                      <div class="amen-slide_img">
                                        <div data-tab="slide" class="img-w">
                                          <div class="img-w"> 
                                              <img loading="lazy" alt="{{ $page->title }}" sizes="(max-width: 1920px) 100vw, 1920px" class="img-p"
                                                  src="{{ Storage::url($mainImage) }}" srcset="{{ implode(', ', $srcset) }}" />

                                                  <div class="img-over-grad from-top"></div>
                                              <div class="img-over-grad from-bot _4x bot"></div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>                   
                                    </div>
                                  </div>
                                </div>
                            @endif
                        @endforeach
                    @endif                                                              
                </div>
    
                  <div class="amm-s_cms_btn-w b-desk">
                    <div class="grid">
                      <div data-scroll-reveal="ctn" class="amm-s_cms_btn" >
                        <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                          <div data-magnetic-inner="" class="btn-circle_label">
                            <a hover-nav-item=""  href="#" class="nav-item w-inline-block">
                              <div class="nav-item_label">
                                <div class="nav-item_label_text">
                                  <div hover="text" class="l1" >Book a Call Now</div>
                                </div>
                                <div class="nav-item_label_text is-2">
                                  <div hover="text" class="l1" >Book a Call Now</div>
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
                          <a  href="#" class="btn-circle_link w-inline-block"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>  

    <section class="section arch clip">
      <div class="container">
        <div class="other-title-w">
          <div class="other-title-s">
            <div class="other-title-s_t">
              <div class="u-160"></div>
              <div class="grid">
                <div class="other-title-s_title">
                  <p data-scroll-reveal="h" class="h3 a-center">{{ $page->title }}</p>
                </div>              
              </div>            
            </div>
            <div class="divider">
              <div data-scroll-reveal="line" class="line-v" ></div>
            </div>
            <div class="other-title-s_b">            
              <div class="grid">
                <div class="s_title">
                  <p data-scroll-reveal="p" class="l1 a-center">
                      {!! $page->content !!}
                  </p>
                </div>
              </div>
              <div class="u-16"></div>
            </div>
          </div>
        </div>
      </div>
  </section>

<section class="section clip">
    <div class="container">
        <div data-video-playpause="" class="arch-scroll-area">
            <div class="arch-intro-s b-desk" >
                <div class="w_bg">
                    <div class="arch-intro-s_bg_l" ></div>
                    <div class="arch-intro-s_bg_r" >
                        <div class="w-embed"></div>
                    </div>
                    <div class="flower arch-intro-l" >
                        @include('parts.flowers.flower_lb2')
                    </div>
                    <div class="flower arch-intro-r">
                        @include('parts.flowers.flower_rb2')                        
                    </div>
                </div>
            </div>
            <div class="arch-w theme_on-color" >
                <div class="arch-s">
                    <div class="arch-s_t">
                        <div class="u-48"></div>
                        <h2 data-text="h" data-fit-text="" class="h1 a-center" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" >A</span><span class="split-char" aria-hidden="true" >r</span><span class="split-char" aria-hidden="true" >c</span><span class="split-char" aria-hidden="true" >h</span><span class="split-char" aria-hidden="true" >i</span><span class="split-char" aria-hidden="true" >t</span><span class="split-char" aria-hidden="true" >e</span><span class="split-char" aria-hidden="true" >c</span><span class="split-char" aria-hidden="true" >t</span><span class="split-char" aria-hidden="true" >u</span><span class="split-char" aria-hidden="true" >r</span><span class="split-char" aria-hidden="true" >e</span></span></h2>
                        <div class="u-32"></div>
                        <div class="grid">
                            <div class="arch-s_desc">
                                <p data-text="p" class="l1 a-center"></p>
                            </div>
                        </div>
                    </div>
                    <div class="arch-s_b">
                        <div class="grid">
                            <div class="arch-s_quote w-clearfix">
                                <div class="red-line"></div>
                                <h3 data-part="p" class="h5">Details</h3>                                
                            </div>
                            <div data-part="ctn" class="arch-s_btn b-desk">
                                <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                                    <div data-magnetic-inner="" class="btn-circle_label">
                                        <a hover-nav-item=""  href="#" class="nav-item w-inline-block">
                                            <div class="nav-item_label">
                                                <div class="nav-item_label_text">
                                                    <div hover="text" class="l1" ><span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">B</span><span class="split-char" aria-hidden="true">o</span>
                                                        <span
                                                        class="split-char" aria-hidden="true">o</span><span class="split-char" aria-hidden="true">k</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">a</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">c</span><span class="split-char"
                                                            aria-hidden="true">a</span><span class="split-char" aria-hidden="true">l</span><span class="split-char" aria-hidden="true">l</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">n</span><span class="split-char"
                                                            aria-hidden="true">o</span><span class="split-char" aria-hidden="true">w</span></span>
                                                            </span>
                                                    </div>
                                                </div>
                                                <div class="nav-item_label_text is-2">
                                                    <div hover="text" class="l1" ><span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" >B</span>
                                                        <span
                                                        class="split-char" aria-hidden="true" >o</span><span class="split-char" aria-hidden="true" >o</span><span class="split-char" aria-hidden="true"
                                                            >k</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" >a</span></span>
                                                            </span>
                                                            <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" >c</span>
                                                            <span
                                                            class="split-char" aria-hidden="true" >a</span><span class="split-char" aria-hidden="true" >l</span><span class="split-char" aria-hidden="true"
                                                                >l</span></span>
                                                                </span> <span class="split-word-mask" aria-hidden="true" ><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" >n</span>
                                                                <span
                                                                class="split-char" aria-hidden="true" >o</span><span class="split-char" aria-hidden="true" >w</span></span>
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
                                    <a  href="#" class="btn-circle_link w-inline-block"></a>
                                </div>
                            </div>
                        </div>
                        <div class="u-96"></div>
                    </div>
                </div>
                <div class="w_bg">
                    <div data-desk="off" data-parallax="w" class="img-w"><img class="img" src="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02.webp" alt="Modern terrace apartments with green plants, flowering vines, and outdoor seating on a sunny day." sizes="(max-width: 1920px) 100vw, 1920px"
                        data-parallax="img" loading="eager" srcset="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-500.png 500w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-800.png 800w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-1080.png 1080w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02.webp 1920w"
                        >
                        <div class="img-over-grad bot _100vh"></div>
                        <div class="img-over-grad bot _100vh"></div>
                    </div>
                </div>
            </div>
            <div class="_100vh b-desk"></div>
            <div class="_100vh b-desk"></div>
            <div class="arch_themes">
                <div data-bg="light" class="arch_themes_light b-desk"></div>
                <div data-bg="color" class="arch_themes_color"></div>
            </div>
        </div>
    </div>
</section>

@endsection