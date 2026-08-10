<section id="hero" class="section clip theme_on-color">
    <div class="container">
        <div class="hero-scroll-area">
            <div data-tabs-hero="" class="hero-w">
                <div class="hero-s">
                    <div class="u-64"></div>
                    <div class="u-272 b-mob"></div>                    
                    <div class="grid">
                        <div class="hero-s_logo">
                            <h1 data-prevent-flicker="" data-scroll-reveal="h" class="h3 a-center">
                                <span class="split-word" aria-hidden="true">Building Trust</span><br>
                                <span class="split-word" aria-hidden="true">Brick by Brick</span>
                            </h1>
                            <div class="hero-s_logo_a">
                                <h2 data-prevent-flicker="" data-scroll-reveal="a" class="a2">Satyamev Royal</h2>
                            </div>
                        
                            <div class="u-24"></div>
                            <h3 data-prevent-flicker="" data-scroll-reveal="h" class="h6 a-center">Since 1997</h3>
                        </div>
                    
                        <span data-tab-trigger="day"></span>
                        <div class="hero-s_tabs_divider is-day"></div>
                    </div>
                </div>
                <div class="hero-w_bg">
                    <div class="hero-w_bg_master">
                        <div class="hero-w_bg_master_img">
                            <div class="pins-cms b-desk w-dyn-list">
                                <div role="list" class="pins-cms_list w-dyn-items">
                                    <?php
                                        $floatingTips = [
                                            [
                                                'id' => 'completed-projects',
                                                'title' => 'Completed Projects',
                                                'top' => '58.3%',
                                                'left' => '26.9%',
                                                'projects' => [
                                                    'Satyamev Royal Parisar',
                                                    'Satyamev S-Cube',
                                                    'Satyamev S-Cube',
                                                    'Satyamev S-Cube',
                                                ]
                                            ],
                                            [
                                                'id' => 'ongoing-projects',
                                                'title' => 'Ongoing Projects',
                                                'top' => '62.5%',
                                                'left' => '57.5%',
                                                'projects' => [
                                                    'Satyamev S-Cube',
                                                    'Satyamev S-Cube',
                                                    'Satyamev S-Cube',
                                                    'Satyamev S-Cube',
                                                ]
                                            ],
                                            [
                                                'id' => 'upcoming-projects',
                                                'title' => 'Upcoming Projects',
                                                'top' => '73.2%',
                                                'left' => '76.6%',
                                                'projects' => [
                                                    'Satyamev Royal 6',
                                                ]
                                            ],
                                        ];
                                    ?>

                                <div class="pins-cms_list">
                                    <?php foreach ($floatingTips as $tip): ?>
                                        <div data-modal-tip-btn="<?= $tip['id']; ?>"
                                            data-pin="<?= $tip['id']; ?>"
                                            floating-tip-trigger="<?= $tip['id']; ?>"
                                            role="listitem" class="pins-cms_list_item w-dyn-item"
                                            style="top: <?= $tip['top']; ?>; left: <?= $tip['left']; ?>;"
                                            >

                                            <div hover-pin class="pin">
                                                <div hover="bg" class="pin_dot">
                                                    <div hover="ico" class="ico-16 theme_on-light">
                                                        <div class="ico w-embed">
                                                            <svg width="100%" height="100%" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 2.66602C8.36819 2.66602 8.66699 2.96579 8.66699 3.33398V7.33301H12.667L12.8008 7.34668C13.1046 7.40886 13.3339 7.67787 13.334 8C13.334 8.36803 13.035 8.66673 12.667 8.66699H8.66699V12.667C8.66673 13.035 8.36803 13.334 8 13.334C7.63205 13.3339 7.33327 13.0349 7.33301 12.667V8.66699H3.33398C2.96579 8.66699 2.66602 8.36819 2.66602 8C2.6661 7.63188 2.96585 7.33301 3.33398 7.33301H7.33301V3.33398C7.33301 2.96585 7.63188 2.6661 8 2.66602Z" fill="currentColor"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pin_bg">
                                                    <div data-pin-pulse class="pin_bg_pulse" style="height:43px;width:43px;opacity:0;"></div>
                                                    <div data-pin-pulse class="pin_bg_pulse" style="height:43px;width:43px;opacity:0;"></div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    <?php endforeach; ?>
                                    </div>                                                                       -->
                                </div>
                            </div>

                            <div data-tab-content="day" class="hero-w_bg_master_img_day">
                                <div data-tab="img" class="img-w h-auto">                                    
                                    <img loading="eager" alt="" sizes="(max-width: 1920px) 100vw, 1920px" class="img h-auto hero-img"
                                        src="assets/images/hero/hero_default.webp" srcset="assets/images/hero/hero_500.webp 500w, assets/images/hero/hero_800.webp 800w, assets/images/hero/hero_1080.webp 1080w, assets/images/hero/hero_1600.webp 1600w, assets/images/hero/hero_1920.webp 1920w" />
                                </div>
                            </div>

                            <div class="img-over-grad from-top _100vh"></div>
                            <div class="img-over-grad from-bot bot _6x"></div>
                            <div class="img-over-grad from-bot bot _6x"></div>
                        </div>

                        <div class="hero-s_b">
                            <div data-prevent-flicker="" data-scroll-reveal="ctn" class="hero-s_btn" >
                                <div class="e-auto">
                                    @include('parts.btn')                                    
                                </div>
                            </div>                            
                            <div class="u-48"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero_themes">
                <div data-bg="color" class="hero_themes_color"></div>
                <div data-bg="light" class="hero_themes_light"></div>
            </div>
        </div>
    </div>
</section>