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
                    <div class="u-48"></div>
                    <div class="u-272"></div>
                    <div class="grid">
                        <div data-sort="" data-filter="" class="apart-s_cms">
                            <div class="apart-s_title">
                                <h1 data-prevent-flicker="" data-scroll-reveal="h" class="h1 a-center mob_a-left">
                                    {{ $page->title }}
                                </h1>
                                <div></div>
                            </div>                           
                    </div>
                </div>                                
            </div>
        </div>
        <div class="u-64"></div>
      </div>

          @include('layouts.header.flower_video')        

        </div>
        </div>
    </section>

    <section data-bg="color" class="section theme_on-color">
        <div data-footer-clip="" class="container" style="clip-path: inset(0%);">
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
                                            <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(-150 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>
                                            <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(30 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>

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
                        <div class="amen-w" style="opacity: 1;">
                          <div class="amen-s">
                            <div data-tabs-hilight="ver" data-tabs="" class="amen-s_cms">
                              <div class="amen-cms w-dyn-list" style="translate: none; rotate: none; scale: none; transform: translate(0px);">
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
                            <a hover-nav-item="" aria-label="Book a call now" href="#" class="nav-item w-inline-block">
                              <div class="nav-item_label">
                                <div class="nav-item_label_text">
                                  <div hover="text" class="l1" aria-label="Book a call now">Book a Call Now</div>
                                </div>
                                <div class="nav-item_label_text is-2">
                                  <div hover="text" class="l1" aria-label="Book a call now">Book a Call Now</div>
                                </div>
                              </div>
                            </a>
                          </div>
                          <div class="btn-circle_bg w-embed">
                            <svg data-circle="" viewBox="0 0 208 208" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                              <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(-150 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>
                              <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(30 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>
                              <circle cx="104" cy="104" r="103.5" stroke="var(--_colors---base-1000--line)" stroke-width="1" fill="none"></circle>
                            </svg>
                          </div>
                          <a aria-label="Book a call now" href="#" class="btn-circle_link w-inline-block"></a>
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
              <div data-scroll-reveal="line" class="line-v" style="visibility: visible; clip-path: inset(0%);"></div>
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

  

  </div>        
        </div>
    </div>
</section>

<section class="section clip">
    <div class="container">
        <div data-video-playpause="" class="arch-scroll-area">
            <div class="arch-intro-s b-desk" style="translate: none; rotate: none; scale: none; transform: translate(0px);">
                <div class="w_bg">
                    <div class="arch-intro-s_bg_l" style="clip-path: polygon(0% 0%, 0% 100%, 44.444% 100%, 44.444% 26.0793%, 98.889% 26.0793%, 98.889% 89.0417%, 44.444% 89.0417%, 1.111% 100%, 100% 100%, 100% 0%);"></div>
                    <div class="arch-intro-s_bg_r" style="clip-path: polygon(0% 0%, 0% 100%, 1.111% 100%, 1.111% 10.9583%, 55.556% 10.9583%, 55.556% 73.9207%, 1.111% 73.9207%, 1.111% 100%, 100% 100%, 100% 0%);">
                        <div class="w-embed"></div>
                    </div>
                    <div class="flower arch-intro-l" style="translate: none; rotate: none; scale: none; transform: rotate(-150deg);">
                        <video muted="" playsinline="playsinline" loop="" disablepictureinpicture="" webkit-playsinline="webkit-playsinline" poster="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a4afbe9a4873ec6185f295d_bougainvillea-flowers_05.avif"
                        class="video">
                            <source src="https://assets.era-residence.com/flowers/bougainvillea-flowers_05.webm" type="video/webm">
                            <source src="https://assets.era-residence.com/flowers/bougainvillea-flowers_05.mov" type="video/mp4">
                        </video>
                    </div>
                    <div class="flower arch-intro-r" style="translate: none; rotate: none; scale: none; transform: rotate(65deg);">
                        <video muted="" playsinline="playsinline" loop="" disablepictureinpicture="" webkit-playsinline="webkit-playsinline" poster="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a4afbe9f3a19844a4b0caf0_bougainvillea-flowers_07.avif"
                        class="video">
                            <source src="https://assets.era-residence.com/flowers/bougainvillea-flowers_07.webm" type="video/webm">
                            <source src="https://assets.era-residence.com/flowers/bougainvillea-flowers_07.mov" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <div class="arch-w theme_on-color" style="translate: none; rotate: none; scale: none; transform-origin: 50% 0% 0px; transform: scale(0.75);">
                <div class="arch-s">
                    <div class="arch-s_t">
                        <div class="u-48"></div>
                        <h2 data-text="h" data-fit-text="" class="h1 a-center" aria-label="Architecture" style="white-space: nowrap; font-size: 326.826px;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">A</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">r</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">c</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">h</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">i</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">t</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">e</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">c</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">t</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">u</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">r</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; transform: translate(0%, -50%) rotateY(-90deg); opacity: 0;">e</span></span></h2>
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
                                <h3 data-part="p" class="h5">The architecture of ERA Residences balances clean contemporary lines with Mediterranean warmth and texture</h3>
                                <div class="u-64"></div>
                                <div class="grid _4-columns">
                                    <div class="arch-s_author">
                                        <div data-part="p" class="l1">By Schiemann Weyers</div>
                                        <div data-part="p" class="l1 reg">Architects OCWA Architects</div>
                                    </div>
                                </div>
                                <div class="u-160 b-desk"></div>
                            </div>
                            <div data-part="ctn" class="arch-s_btn b-desk">
                                <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                                    <div data-magnetic-inner="" class="btn-circle_label">
                                        <a hover-nav-item="" aria-label="Book a call now" href="#" class="nav-item w-inline-block">
                                            <div class="nav-item_label">
                                                <div class="nav-item_label_text">
                                                    <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">B</span><span class="split-char" aria-hidden="true">o</span>
                                                        <span
                                                        class="split-char" aria-hidden="true">o</span><span class="split-char" aria-hidden="true">k</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">a</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">c</span><span class="split-char"
                                                            aria-hidden="true">a</span><span class="split-char" aria-hidden="true">l</span><span class="split-char" aria-hidden="true">l</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">n</span><span class="split-char"
                                                            aria-hidden="true">o</span><span class="split-char" aria-hidden="true">w</span></span>
                                                            </span>
                                                    </div>
                                                </div>
                                                <div class="nav-item_label_text is-2">
                                                    <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">B</span>
                                                        <span
                                                        class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true"
                                                            style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">k</span></span>
                                                            </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">a</span></span>
                                                            </span>
                                                            <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">c</span>
                                                            <span
                                                            class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">a</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">l</span><span class="split-char" aria-hidden="true"
                                                                style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">l</span></span>
                                                                </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">n</span>
                                                                <span
                                                                class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">w</span></span>
                                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="btn-circle_bg w-embed">
                                        <svg data-circle="" viewBox="0 0 208 208" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                                            <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(-150 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>
                                            <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(30 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>

                                            <circle cx="104" cy="104" r="103.5" stroke="var(--_colors---base-1000--line)" stroke-width="1" fill="none"></circle>
                                        </svg>
                                    </div>
                                    <a aria-label="Book a call now" href="#" class="btn-circle_link w-inline-block"></a>
                                </div>
                            </div>
                        </div>
                        <div class="u-96"></div>
                    </div>
                </div>
                <div class="w_bg">
                    <div data-desk="off" data-parallax="w" class="img-w"><img class="img" src="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02.webp" alt="Modern terrace apartments with green plants, flowering vines, and outdoor seating on a sunny day." sizes="(max-width: 1920px) 100vw, 1920px"
                        data-parallax="img" loading="eager" srcset="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-500.png 500w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-800.png 800w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02-p-1080.png 1080w, https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a0f8994091fd12c24e79c8a_img_cam_02.webp 1920w"
                        style="translate: none; rotate: none; scale: none; transform: translate(0px);">
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


<div class="amen-scroll-area">
    <div class="scroll-area_screen">
        <section class="section clip theme_on-color">
            <div class="container">
                <div class="amen-w" style="opacity: 1;">
                    <div class="amen-s">
                        <div data-tabs-hilight="ver" data-tabs="" class="amen-s_cms">
                            <div class="amen-cms w-dyn-list" >
                                <?php
                                    $amenities = [
                                        [
                                            'tab' => 'gated-community',
                                            'title' => 'Gated Community',
                                            'desc' => 'Instead of corridors, walking paths connect the apartments',
                                            'image' => 'assets/images/big_gallery/gated-community.webp'
                                        ],
                                        [
                                            'tab' => 'swimming-pool-2',
                                            'title' => 'Swimming Pool',
                                            'desc' => 'Saltwater swimming pool, Children’s pool, Sauna, jacuzzi and wellness shower',
                                            'image' => 'assets/images/big_gallery/pool.webp'
                                        ],
                                        [
                                            'tab' => 'parking',
                                            'title' => 'Parking Area',
                                            'desc' => 'Each parking space includes pre-installation for optional EV charging.',
                                            'image' => 'assets/images/big_gallery/parking.webp'
                                        ],
                                        [
                                            'tab' => 'spa-gym',
                                            'title' => 'Spa & Gym',
                                            'desc' => 'Designed exclusively for residents and their guests, the amenities encourage a slower and more balanced lifestyle.',
                                            'image' => 'assets/images/big_gallery/spa-gym.webp'
                                        ],
                                        [
                                            'tab' => 'landscaping',
                                            'title' => 'Landscaping',
                                            'desc' => 'The landscaping concept was designed to soften the architecture and strengthen the connection between the residences and nature.',
                                            'image' => 'assets/images/big_gallery/landscaping.webp'
                                        ],
                                    ];
                                ?>

                                <div role="list" class="amen-cms_list w-dyn-items">
                                    <?php foreach ($amenities as $index => $item): ?>
                                        <div
                                            data-reveal-first
                                            data-tab-content="<?= $item['tab']; ?>"
                                            role="listitem"
                                            class="amen-cms_list_item w-dyn-item <?= $index == 0 ? 'is-active' : ''; ?>"
                                            style="<?= $index == 0
                                                ? 'z-index:1;position:relative;display:block;'
                                                : 'z-index:0;position:absolute;display:none;'; ?>">

                                            <div data-parallax="w" class="amen-slide">
                                                <div class="amen-slide_b">
                                                    <div class="grid">
                                                        <div class="amen-slide_title">
                                                            <h3 data-scroll-reveal="p" data-tab="p" class="l1"><?= $item['title']; ?></h3>
                                                            <div class="u-32"></div>
                                                        </div>
                                                        <div class="amen-slide_desc w-clearfix">
                                                            <div class="red-line"></div>
                                                            <h4 data-scroll-reveal="p" data-tab="p" class="h5"><?= $item['desc']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="u-48"></div>
                                                </div>

                                                <div class="amen-slide_img">
                                                    <div data-tab="slide" class="img-w">
                                                        <div class="img-w">
                                                            <img data-parallax="img-in" src="<?= $item['image']; ?>" class="img-p" alt="<?= $item['title']; ?>">
                                                        </div>
                                                        <div class="img-over-grad from-top"></div>
                                                        <div class="img-over-grad from-bot _4x bot"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div> 

                                <!-- <div role="list" class="amen-cms_list w-dyn-items">
                                    <div data-reveal-first="" data-tab-content="gated-community" role="listitem" class="amen-cms_list_item w-dyn-item is-active" style="z-index: 1; position: relative; display: block;">
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-scroll-reveal="p" data-tab="p" class="l1">Gated Community</h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-scroll-reveal="p" data-tab="p" class="h5">
                                                            <span class="split-line-mask" aria-hidden="true" >
                                                                <span class="split-line" aria-hidden="true" >
                                                                    <span class="split-word" aria-hidden="true">Instead</span> <span class="split-word" aria-hidden="true">of</span> <span class="split-word" aria-hidden="true">corridors,</span> <span class="split-word" aria-hidden="true">walking</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">paths</span> <span class="split-word" aria-hidden="true">connect</span> <span class="split-word" aria-hidden="true">the</span> <span class="split-word" aria-hidden="true">apartments</span> <span class="split-word" aria-hidden="true">—</span> <span class="split-word" aria-hidden="true">making</span> <span class="split-word" aria-hidden="true">Era</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Residence</span> <span class="split-word" aria-hidden="true">feel</span> <span class="split-word" aria-hidden="true">closer</span> <span class="split-word" aria-hidden="true">to</span> <span class="split-word" aria-hidden="true">a</span> <span class="split-word" aria-hidden="true">group</span> <span class="split-word" aria-hidden="true">of</span> <span class="split-word" aria-hidden="true">private</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">homes</span> <span class="split-word" aria-hidden="true">than</span> <span class="split-word" aria-hidden="true">a</span> 
                                                                    <span class="split-word" aria-hidden="true">standard</span></span>
                                                                </span>
                                                            </h4>
                                                    </div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" style="clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);">
                                                    <div class="img-w" style="translate: none; rotate: none; scale: none; transform: translate(0px);">
                                                        <img data-parallax="img-in" loading="eager" alt="" 
                                                        src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community.webp" 
                                                        sizes="100vw" 
                                                        srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community-p-500.webp 500w, 
                                                        https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community-p-800.webp 800w, 
                                                        https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community-p-1080.webp 1080w, 
                                                        https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community-p-1600.webp 1600w, 
                                                        https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1512e5b24991c76981118b_era-residence-gated-community.webp 1920w"
                                                        class="img-p"></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="swimming-pool-2" role="listitem" class="amen-cms_list_item w-dyn-item" style="z-index: 0; position: absolute; display: none;">
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Swimming Pool"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Swimming</span> <span class="split-word" aria-hidden="true">Pool</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Saltwater swimming pool, Children’s pool, Sauna, jacuzzi and wellness shower"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Saltwater</span> <span class="split-word" aria-hidden="true">swimming</span> <span class="split-word" aria-hidden="true">pool,</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Children’s</span> <span class="split-word" aria-hidden="true">pool,</span> <span class="split-word" aria-hidden="true">Sauna,</span> <span class="split-word" aria-hidden="true">jacuzzi</span> <span class="split-word" aria-hidden="true">and</span> <span class="split-word" aria-hidden="true">wellness</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">shower</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" style="clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);">
                                                    <div class="img-w" style="translate: none; rotate: none; scale: none; transform: translate(-25%, 0%) scale(1.5);">
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-500.webp 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-800.webp 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-1080.webp 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-1600.webp 1600w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool.webp 1920w"
                                                        class="img-p" style="translate: none; rotate: none; scale: none; transform: translate3d(0px, 0px, 10px);"></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="swimming-pool" role="listitem" class="amen-cms_list_item w-dyn-item" style="z-index: 0; position: absolute; display: none;">
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Parking area"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Parking</span> <span class="split-word" aria-hidden="true">area</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Each parking space includes pre-installation for optional EV charging."><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Each</span> <span class="split-word" aria-hidden="true">parking</span> <span class="split-word" aria-hidden="true">space</span> <span class="split-word" aria-hidden="true">includes</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">pre-installation</span> <span class="split-word" aria-hidden="true">for</span> <span class="split-word" aria-hidden="true">optional</span> <span class="split-word" aria-hidden="true">EV</span> <span class="split-word" aria-hidden="true">charging.</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" style="clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);">
                                                    <div class="img-w" style="translate: none; rotate: none; scale: none; transform: translate(-25%, 0%) scale(1.5);">
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking-p-500.png 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking-p-800.png 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking.webp 1920w"
                                                        class="img-p" style="translate: none; rotate: none; scale: none; transform: translate3d(0px, 0px, 10px);"></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="spa-gym" role="listitem" class="amen-cms_list_item w-dyn-item" style="z-index: 0; position: absolute; display: none;">
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Spa &amp; gym"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Spa</span> <span class="split-word" aria-hidden="true">&amp;</span> <span class="split-word" aria-hidden="true">gym</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Designed exclusively for residents and their guests, the amenities at ERA encourage a slower and more balanced Mediterranean lifestyle"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Designed</span> <span class="split-word" aria-hidden="true">exclusively</span> <span class="split-word" aria-hidden="true">for</span> <span class="split-word" aria-hidden="true">residents</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">and</span> <span class="split-word" aria-hidden="true">their</span> <span class="split-word" aria-hidden="true">guests,</span> <span class="split-word" aria-hidden="true">the</span> <span class="split-word" aria-hidden="true">amenities</span> <span class="split-word" aria-hidden="true">at</span> <span class="split-word" aria-hidden="true">ERA</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">encourage</span> <span class="split-word" aria-hidden="true">a</span> <span class="split-word" aria-hidden="true">slower</span> <span class="split-word" aria-hidden="true">and</span> <span class="split-word" aria-hidden="true">more</span> <span class="split-word" aria-hidden="true">balanced</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Mediterranean</span> <span class="split-word" aria-hidden="true">lifestyle</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" style="clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);">
                                                    <div class="img-w" style="translate: none; rotate: none; scale: none; transform: translate(-25%, 0%) scale(1.5);">
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-500.webp 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-800.webp 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-1080.webp 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-1600.webp 1600w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym.webp 1920w"
                                                        class="img-p" style="translate: none; rotate: none; scale: none; transform: translate3d(0px, 0px, 10px);"></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="landscaping" role="listitem" class="amen-cms_list_item w-dyn-item" style="z-index: 0; position: absolute; display: none;">
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Landscaping"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">Landscaping</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="The landscaping concept was designed to soften the architecture and strengthen the connection between the residences and the Mediterranean environment."><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">The</span> <span class="split-word" aria-hidden="true">landscaping</span> <span class="split-word" aria-hidden="true">concept</span> <span class="split-word" aria-hidden="true">was</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">designed</span> <span class="split-word" aria-hidden="true">to</span> <span class="split-word" aria-hidden="true">soften</span> <span class="split-word" aria-hidden="true">the</span> <span class="split-word" aria-hidden="true">architecture</span> <span class="split-word" aria-hidden="true">and</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">strengthen</span> <span class="split-word" aria-hidden="true">the</span> <span class="split-word" aria-hidden="true">connection</span> <span class="split-word" aria-hidden="true">between</span> <span class="split-word" aria-hidden="true">the</span> </span></span><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" style="text-align: start; translate: none; rotate: none; scale: none; transform: translate(0%, -110%);"><span class="split-word" aria-hidden="true">residences</span> <span class="split-word" aria-hidden="true">and</span> <span class="split-word" aria-hidden="true">the</span> <span class="split-word" aria-hidden="true">Mediterranean</span> <span class="split-word" aria-hidden="true">environment.</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" style="clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%);">
                                                    <div class="img-w" style="translate: none; rotate: none; scale: none; transform: translate(-25%, 0%) scale(1.5);">
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-500.png 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-800.png 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-1080.png 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping.webp 1920w"
                                                        class="img-p" style="translate: none; rotate: none; scale: none; transform: translate3d(0px, 0px, 10px);"></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="amm-s_cms_tabs-w">
                                <div class="grid">
                                    <div class="amm-s_cms_tabs">
                                        <div class="amen-tabs-cms w-dyn-list">
                                            <div role="list" class="amen-tabs-cms_list w-dyn-items">
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="gated-community" class="amen-tab is-active">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Gated community"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Gated</span>                                                            <span class="split-word" aria-hidden="true">community</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="swimming-pool-2" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Swimming Pool"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Swimming</span>                                                            <span class="split-word" aria-hidden="true">Pool</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="swimming-pool" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Parking area"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Parking</span>                                                            <span class="split-word" aria-hidden="true">area</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="spa-gym" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Spa &amp; gym"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Spa</span>                                                            <span class="split-word" aria-hidden="true">&amp;</span> <span class="split-word" aria-hidden="true">gym</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="landscaping" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Landscaping"><span class="split-line-mask" aria-hidden="true" ><span class="split-line" aria-hidden="true" ><span class="split-word" aria-hidden="true">Landscaping</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-scroll-reveal="line" class="amm-s_cms_tabs_line" style="visibility: visible; clip-path: inset(0%);">
                                            <div data-tab-hilight="" class="amm-s_cms_tabs_line_hilight" style="translate: none; rotate: none; scale: none; height: 34px; transform: translate(0px);"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amm-s_cms_btn-w b-desk">
                                <div class="grid">
                                    <div data-scroll-reveal="ctn" class="amm-s_cms_btn" style="visibility: visible; translate: none; rotate: none; scale: none; transform: translate(0px); opacity: 1;">
                                        <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                                            <div data-magnetic-inner="" class="btn-circle_label">
                                                <a hover-nav-item="" aria-label="Book a call now" href="#" class="nav-item w-inline-block">
                                                    <div class="nav-item_label">
                                                        <div class="nav-item_label_text">
                                                            <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">B</span><span class="split-char"
                                                                aria-hidden="true">o</span><span class="split-char" aria-hidden="true">o</span><span class="split-char" aria-hidden="true">k</span></span>
                                                                </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">a</span></span>
                                                                </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">c</span><span class="split-char"
                                                                aria-hidden="true">a</span><span class="split-char" aria-hidden="true">l</span><span class="split-char" aria-hidden="true">l</span></span>
                                                                </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true">n</span><span class="split-char"
                                                                aria-hidden="true">o</span><span class="split-char" aria-hidden="true">w</span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="nav-item_label_text is-2">
                                                            <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">B</span>
                                                                <span
                                                                class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true"
                                                                    style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">k</span></span>
                                                                    </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">a</span></span>
                                                                    </span>
                                                                    <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">c</span>
                                                                    <span
                                                                    class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">a</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">l</span><span class="split-char" aria-hidden="true"
                                                                        style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">l</span></span>
                                                                        </span> <span class="split-word-mask" aria-hidden="true" style="overflow: clip;"><span class="split-word" aria-hidden="true"><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">n</span>
                                                                        <span
                                                                        class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">o</span><span class="split-char" aria-hidden="true" style="translate: none; rotate: none; scale: none; opacity: 0; transform: translate(0%, 100%);">w</span></span>
                                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="btn-circle_bg w-embed">
                                                <svg data-circle="" viewBox="0 0 208 208" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                                                    <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(-150 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>
                                                    <circle data-arc="" cx="104" cy="104" r="103.5" stroke="currentColor" stroke-width="1" fill="none" transform="rotate(30 104 104)" style="stroke-dasharray: 27.1179px, 650.31px;"></circle>

                                                    <circle cx="104" cy="104" r="103.5" stroke="var(--_colors---base-1000--line)" stroke-width="1" fill="none"></circle>
                                                </svg>
                                            </div>
                                            <a aria-label="Book a call now" href="#" class="btn-circle_link w-inline-block"></a>
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
    <div class="hero_themes">
        <div data-bg="color" class="hero_themes_color"></div>
        <div data-bg="light" class="hero_themes_light"></div>
    </div>
</div>

@endsection