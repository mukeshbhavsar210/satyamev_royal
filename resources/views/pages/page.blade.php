@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<main data-barba-namespace="contact" data-barba="container" class="transition-container" data-bg="light">
    <section class="section">
        <div class="container">            
            <div class="u-272"></div>
            <div class="grid">
                <div class="apart-s_cms">
                    <h3 data-prevent-flicker="" data-scroll-reveal="h" class="h3">{{ $page->title }}</h3>
                    <div class="u-16"></div>
                    <h4 class="h4">{!! $page->content !!}</h4>
                </div>
            </div>
            <div data-video-playpause="" data-parallax="ctn-down" class="flower apart" >
                @include('parts.flowers.flower_rt')                    
            </div>            
        </div>        
    </section>

    <section class="clip">
        <div class="loc-w">
            <div class="loc-w_over-grad"></div>
            <div class="loc-w_over-grad"></div>
            <?php
                $clouds = [
                    [
                        'src' => 'images/clouds/clouds1.avif',
                        'srcset' => 'images/clouds/clouds_5001.avif 500w, images/clouds/clouds_21461.avif 2146w',
                        'sizes' => '(max-width: 2146px) 100vw, 2146px',
                        'class' => 'is-33',
                        'lists' => [3, 2],
                    ],
                    [
                        'src' => 'images/clouds/clouds_47.avif',
                        'srcset' => '',
                        'sizes' => '',
                        'class' => 'is-47',
                        'lists' => [2, 2],
                    ],
                    [
                        'src' => 'images/clouds/clouds_02.avif',
                        'srcset' => '',
                        'sizes' => '',
                        'class' => 'is-02',
                        'lists' => [2, 2],
                    ],
                ];
            ?>
                
            <?php foreach ($clouds as $cloud): ?>
                <div class="loc-w_clouds">
                    <div data-marquee-css class="marquee">
                        <div data-marquee-css="track" class="marquee_track">
                            <?php foreach ($cloud['lists'] as $count): ?>
                                <div data-marquee-css="list" class="marquee_list">
                                    <?php for ($i = 0; $i < $count; $i++): ?>
                                        <div class="marquee_list_item">
                                            <img src="<?= $cloud['src']; ?>" loading="eager" alt="" class="clouds <?= $cloud['class']; ?>"
                                                <?php if (!empty($cloud['srcset'])): ?>
                                                    sizes="<?= $cloud['sizes']; ?>" srcset="<?= $cloud['srcset']; ?>"
                                                <?php endif; ?>
                                            >
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        

        <section data-bg="color" class="section theme_on-color">
            <div data-footer-clip="" class="container">
                <div class="cta-w">
                    <div class="cta-s">
                        <div class="u-48"></div>                    
                        <div class="u-272"></div>
                        <div class="u-272"></div>
                        <div class="u-272"></div>
                        <div class="grid">
                            <div class="cta-s_title">
                                <h3 data-scroll-reveal="h" class="h3 a-center">{{ $page->featured_title }}</h3>
                                <div class="u-32"></div>
                                <h3 data-scroll-reveal="h" class="c1 a-center">{{ $page->featured_description }}</h3>
                                <div class="u-160"></div>
                                <div data-scroll-reveal="ctn" class="cta-s_title_btn" >
                                    <div hover-btn-circle="" data-magnetic-btn="" hover-nav-item-trigger="" class="btn-circle">
                                        <div data-magnetic-inner="" class="btn-circle_label">
                                            <a hover-nav-item=""  href="/apartments" aria-current="page" class="nav-item w-inline-block w--current">
                                                <div class="nav-item_label">
                                                    <div class="nav-item_label_text">
                                                        <div hover="text" class="l1" >View Apartments</div>
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

                    <div class="grid">
                        <div data-sort="" data-filter="" class="apart-s_cms">
                            <div class="w_bg">
                                <div data-parallax="w" class="img-w">
                                    @if($page->image)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($page->image) }}" alt="{{ $page->title }}" loading="eager" alt="Showcase" sizes="(max-width: 1920px) 100vw, 1920px" class="img-p">
                                    @endif

                                    <div class="img-over-grad from-top _4x"></div>
                                    <div class="img-over-grad"></div>
                                    <div class="img-over-grad"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
    </section>

        @php
            $pageImages = $page->images ?? collect();
        @endphp

        @if ($pageImages->isNotEmpty())
            <div class="pages_images">
                @foreach ($pageImages as $pageImage)
                    @php
                        $images = $pageImage->image ?? [];

                        $srcset = collect($images)
                            ->sortKeys()
                            ->map(fn ($path, $size) => Storage::url($path) . " {$size}w")
                            ->implode(', ');

                        // Prefer the largest available image
                        $mainImage =
                            $images[1920]
                            ?? $images[1600]
                            ?? $images[1080]
                            ?? $images[800]
                            ?? $images[500]
                            ?? null;
                    @endphp

                    @if ($mainImage)
                        <div class="gallery2" data-parallax-image>
                            <div class="gallery-image">
                                <img src="{{ Storage::url($mainImage) }}" srcset="{{ $srcset }}"
                                    sizes="(max-width: 500px) 500px,
                                        (max-width: 800px) 800px,
                                        (max-width: 1080px) 1080px,
                                        (max-width: 1600px) 1600px,
                                        1920px"
                                    alt="{{ $page->title }}" class="img-p"
                                />
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

</main>   
@endsection