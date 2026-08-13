<section data-bg="light" data-slow-scroll="" class="section clip">
    <div class="container loc">
        <div data-video-playpause="" data-scroll-horizontal="" class="loc-scroll-area" style="height: 4279px;">
            <div class="loc-scroll-area_screen">
                <div class="loc-scroll-area_track">
                    <div data-parallax="w" class="loc-info-w">
                        <div data-parallax="img-in" class="loc-info-s">
                            <div class="loc-info-s_t">
                                <div class="u-48"></div>
                                <div class="u-160 b-mob"></div>
                            </div>
                            <div class="loc-info-s_c">
                                <div class="grid">
                                    <div class="s_title">
                                        <h2 data-part="p" class="l1 a-center">
                                            <span class="split-line-mask" aria-hidden="true" >
                                                <span class="split-line" aria-hidden="true">
                                                    <span class="split-word" aria-hidden="true">Our</span>
                                                    <span class="split-word" aria-hidden="true">Journey</span>
                                                </span>
                                            </span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="u-24 b-desk"></div>
                                <div class="u-160 b-mob"></div>
                                <div class="grid">
                                    <div class="info-s_lead">
                                        <h3 data-part="p" class="h4 a-center">
                                            <span class="split-line-mask">
                                                <span class="split-line">Our Timeline</span>
                                            </span>
                                        </h3>

                                                                                                                     
                                    </div>
                                </div>
                                <div class="u-48 b-mob"></div>
                            </div>
                            <div class="loc-info-s_b"></div>
                        </div>
                        <div data-parallax="ctn-down" class="flower loc-info" style="translate: none; rotate: none; scale: none; transform: translate(0%, -10%);">
                            <video muted="" playsinline="playsinline" loop="" disablepictureinpicture="" webkit-playsinline="webkit-playsinline" 
                                poster="assets/media/flowers_01.avif" class="video">
                                <source src="assets/media/flowers_01.webm" type="video/webm">
                                <source src="assets/media/flowers_01.mov" type="video/mp4">
                            </video>
                        </div>
                    </div>  

                    <div class="loc-intro-w">
                        <div class="loc-intro-s">
                            <div class="u-64 b-desk"></div>
                            <div class="u-160 b-mob"></div>
                            
                            <div class="grid">
                                <!-- <div class="loc-path-s_title">
                                    <h2 class="h4 a-center">
                                        <span data-scroll-reveal="h" class="loc-path-s_title_line">Our Timeline</span>
                                        <span data-scroll-reveal="a" class="loc-path-s_title_a a2">yours</span>
                                        <span data-scroll-reveal="h" class="loc-path-s_title_line">This Year</span>
                                    </h2>
                                </div> -->

                                <div class="other-s_cms">                                    
                                    @foreach($timelines as $timeline)
                                    <div class="timeline">
                                        <div class="timeline-nav-wrapper">                                            
                                            <button type="button" class="timeline-arrow timeline-prev">
                                                &#10094;
                                            </button>
                                            <div class="timeline-nav">
                                                {{ $timeline->year }}
                                                {{-- <?php foreach ($timeline as $index => $item): ?>
                                                    <button type="button" class="timeline-year h5 <?php echo $index === 0 ? 'active' : ''; ?>"
                                                        data-index="<?php echo $index; ?>" >
                                                        {{ $timeline->year }}
                                                        <?php echo htmlspecialchars($item['year']); ?>
                                                    </button>
                                                <?php endforeach; ?> --}}
                                            </div>

                                            <button type="button" class="timeline-arrow timeline-next">
                                                &#10095;
                                            </button>
                                        </div>

                                        <div class="timeline-content">
                                            <?php foreach ($timeline as $index => $item): ?>
                                                <div class="timeline-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                                                    data-index="<?php echo $index; ?>" >

                                                    <div class="timeline-image">
                                                        @if($timeline->image)                                                    
                                                            <img src="{{ Storage::url($timeline->image) }}" alt="{{ $timeline->title }}" >                                                    
                                                        @endif
                                                        {{-- <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" > --}}
                                                    </div>

                                                    <div class="timeline-info">
                                                        <h4 class="h4">{{ $timeline->title }}</h4>
                                                        <div class="u-16"></div>
                                                        <p>{!! $timeline->description !!}</p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>                                                          
                                    @endforeach                                    

                                    <?php
                                        $timeline = [
                                            [
                                                'year'  => '1997',
                                                'title' => 'Satyamev Chaavani',
                                                'image' => 'assets/images/timeline/timeline01.jpg',
                                                'description' => 'A haven of contemporary living in Chandkheda, Ahmedabad. Built in 2019, this residential masterpiece offers a perfect blend of comfort and style. Immerse yourself in a world of modern amenities, thoughtfully designed living spaces, and a location that ensures convenience. Welcome to a life of elevated living at Satyamev Royal 3. '
                                            ],
                                            [
                                                'year'  => '1998',
                                                'title' => 'Satyamev Royal 4',
                                                'image' => 'assets/images/timeline/timeline02.jpg',
                                                'description' => 'We completed our first major project and expanded our capabilities.'
                                            ],
                                            [
                                                'year'  => '1999',
                                                'title' => 'Growing the Team',
                                                'image' => 'assets/images/timeline/timeline03.jpg',
                                                'description' => 'Our team grew and we started working with clients across multiple locations.'
                                            ],
                                            [
                                                'year'  => '2000',
                                                'title' => 'New Office',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We opened our new office and continued expanding the business.'
                                            ],
                                            [
                                                'year'  => '2001',
                                                'title' => 'Major Expansion',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'The company entered new markets and launched several new projects.'
                                            ],
                                            [
                                                'year'  => '2002',
                                                'title' => 'New Milestone',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We achieved another important milestone in our journey.'
                                            ],
                                            [
                                                'year'  => '2003',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2004',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2005',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2006',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2007',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2008',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2009',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2010',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2011',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2012',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2013',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2014',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2015',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2016',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2017',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ],
                                            [
                                                'year'  => '2018',
                                                'title' => 'Future Vision',
                                                'image' => 'assets/images/timeline/timeline.webp',
                                                'description' => 'We continue to innovate and build towards an exciting future.'
                                            ]
                                        ];
                                    ?>
                            
                                    {{-- <div class="timeline">
                                        <div class="timeline-nav-wrapper">                                            
                                            <button type="button" class="timeline-arrow timeline-prev">
                                                &#10094;
                                            </button>
                                            <div class="timeline-nav">
                                                <?php foreach ($timeline as $index => $item): ?>
                                                    <button type="button" class="timeline-year h5 <?php echo $index === 0 ? 'active' : ''; ?>"
                                                        data-index="<?php echo $index; ?>" >
                                                        <?php echo htmlspecialchars($item['year']); ?>
                                                    </button>
                                                <?php endforeach; ?>
                                            </div>

                                            <button type="button" class="timeline-arrow timeline-next">
                                                &#10095;
                                            </button>
                                        </div>

                                        <div class="timeline-content">
                                            <?php foreach ($timeline as $index => $item): ?>
                                                <div class="timeline-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                                                    data-index="<?php echo $index; ?>" >

                                                    <div class="timeline-image">
                                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" >
                                                    </div>

                                                    <div class="timeline-info">
                                                        <h4 class="h4"><?php echo htmlspecialchars($item['title']); ?></h4>
                                                        <div class="u-16"></div>
                                                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div> --}}

                                    
                                    <div class="timeline-list">
                                        @foreach($timelines as $timeline)
                                            <div class="timeline-item">
                                                <div class="timeline-year">{{ $timeline->year }}</div>
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
                                </div>                                                                             
                            </div>                                                                                     
                        </div>                        

                        <div class="flower loc-intro">
                            <video muted="" playsinline="playsinline" loop="" disablepictureinpicture="" webkit-playsinline="webkit-playsinline" poster="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a4afbe941e5e917a8f84c4a_bougainvillea-flowers_02.avif" class="video">
                                <source src="assets/media/bougainvillea-flowers_02.webm" type="video/webm">
                                <source src="assets/media/bougainvillea-flowers_02.mov" type="video/mp4">
                            </video>
                        </div> 

                        <div class="loc-path-w_flower">
                            <div class="flower loc-path" style="translate: none; rotate: none; scale: none; transform: rotate(180deg) scale(1, -1);">
                                <video muted="" playsinline="playsinline" loop="" disablepictureinpicture="" webkit-playsinline="webkit-playsinline" poster="https://cdn.prod.website-files.com/6a068da7ad91b057365bf967/6a4afbe988f8dc3c9bb1647a_bougainvillea-flowers_03.avif" class="video">
                                    <source src="assets/media/bougainvillea-flowers_03.webm" type="video/webm">
                                    <source src="assets/media/bougainvillea-flowers_03.mov" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div data-slow-scroll="" class="slow-scroll-trigger"></div>
        </div>
    </div>
</section>