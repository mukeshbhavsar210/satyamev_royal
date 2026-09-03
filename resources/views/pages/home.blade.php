@extends('layouts.app')

@section('content')

<main data-barba-namespace="home" data-barba="container" class="transition-container" data-bg="">
    <section id="hero" class="section clip theme_on-color">
        <div class="container">
            <div class="hero-scroll-area">
                <div data-tabs-hero="" class="hero-w">
                    <div class="hero-s">
                        <div class="u-64"></div>
                        <div class="u-272 b-mob"></div>                    
                        <div class="grid">
                            <div class="hero-s_logo">
                                <h3 data-prevent-flicker="" data-scroll-reveal="h" class="h1 a-center">
                                    <span class="split-word">Satyamev</span><br />
                                    <span class="split-word">Group</span>
                                </h3>
                                <div class="hero-s_logo_a">
                                    <h2 data-prevent-flicker="" data-scroll-reveal="a" class="a2">Since {{ setting('since') }}</h2>
                                </div>                                                            
                            </div>

                            <div class="u-24"></div>
                            <span data-tab-trigger="day"></span>
                            <div class="hero-s_tabs_divider is-day"></div>
                        </div>
                        <div class="u-48"></div>
                        <div class="grid">
                            <h3 class="hero-s_title h5">                            
                                <span data-scroll-reveal="h" data-prevent-flicker="" class="a-left">
                                    <div class="span">{{ setting('punch_line1') }}</div>
                                </span>                            
                                <span data-scroll-reveal="h" data-prevent-flicker="" class="a-right">
                                    <div class="span">{{ setting('punch_line2') }}</div>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="hero-w_bg">
                        <div class="hero-w_bg_master">
                            <div class="hero-w_bg_master_img">
                                <div class="pins-cms b-desk w-dyn-list">
                                    <div role="list" class="pins-cms_list w-dyn-items">
                                        <div class="pins-cms_list">
                                            @foreach($floatingTips as $project)
                                                @php
                                                    $category = $project->category;
                                                @endphp

                                                <div
                                                    data-modal-tip-btn="{{ $category }}"
                                                    data-pin="{{ $category }}"
                                                    floating-tip-trigger="{{ $category }}"
                                                    role="listitem"
                                                    @class([
                                                        'pins-cms_list_item',
                                                        'w-dyn-item',
                                                        'ongoing' => $category === 'ongoing',
                                                        'upcoming' => $category === 'upcoming',
                                                        'completed' => $category === 'completed',
                                                    ])
                                                >
                                                    <div hover-pin class="pin">
                                                        <div hover="bg" class="pin_dot">
                                                            <div hover="ico" class="ico-16 theme_on-light">
                                                                <div class="ico w-embed">
                                                                    <svg width="100%" height="100%" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                                        <path d="M8 2.66602C8.36819 2.66602 8.66699 2.96579 8.66699 3.33398V7.33301H12.667L12.8008 7.34668C13.1046 7.40886 13.3339 7.67787 13.334 8C13.334 8.36803 13.035 8.66673 12.667 8.66699H8.66699V12.667C8.66673 13.035 8.36803 13.334 8 13.334C7.63205 13.3339 7.33327 13.0349 7.33301 12.667V8.66699H3.33398C2.96579 8.66699 2.66602 8.36819 2.66602 8C2.6661 7.63188 2.96585 7.33301 3.33398 7.33301H7.33301V3.33398C7.33301 2.96585 7.63188 2.6661 8 2.66602Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                            <div class="pin_bg">
                                                                <div data-pin-pulse class="pin_bg_pulse"></div>
                                                                <div data-pin-pulse class="pin_bg_pulse"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div data-tab-content="day" class="hero-w_bg_master_img_day">
                                    <div data-tab="img" class="img-w h-auto">
                                        @php
                                            $hero = setting('hero', []);
                                        @endphp                                

                                        @if (!empty($hero))
                                            <img loading="eager" alt="" sizes="(max-width: 1920px) 100vw, 1920px" class="img h-auto hero-img"
                                                src="{{ Storage::url($hero['1920'] ?? $hero['1080'] ?? '') }}"
                                                srcset="
                                                    @if(isset($hero['500'])){{ Storage::url($hero['500']) }} 500w,@endif
                                                    @if(isset($hero['800'])){{ Storage::url($hero['800']) }} 800w,@endif
                                                    @if(isset($hero['1080'])){{ Storage::url($hero['1080']) }} 1080w,@endif
                                                    @if(isset($hero['1600'])){{ Storage::url($hero['1600']) }} 1600w,@endif
                                                    @if(isset($hero['1920'])){{ Storage::url($hero['1920']) }} 1920w,@endif
                                                "
                                            />
                                        @endif
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

    <div class="floating-tips w-dyn-list">
        <div role="list" class="floating-tips_list w-dyn-items">
            @foreach($floatingTips->groupBy('category') as $category => $projects)
                <div floating-tip="{{ $category }}" role="listitem" class="floating-tip w-dyn-item">
                    <div class="floating-tip-card">
                        <div class="floating-tip-card_t">
                            <h1 class="h5">{{ ucfirst($category) }}</h1>
                        </div>

                        <div class="floating-tip-card_b">
                            <ul class="p1">
                                @foreach($projects as $project)
                                    <li>{{ $project->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        
    <section class="section arch clip theme_on-brand" 
        @if(setting('arch_color'))
            style="background-color: {{ setting('arch_color') }}"
        @endif>
        
        <div class="container">
            <div class="benefits-intro-w">
                <div class="benefits-intro-s">
                    <div class="u-48 b-mob"></div>
                    <div class="u-272 b-mob"></div>
                    <div class="s_logo">
                        <div class="info-s_logo_l">
                            <div data-scroll-reveal="p" class="l1 a-center">
                                <span class="split-line-mask"  >
                                    <span class="split-line"  >
                                        <span class="split-word" >{{ setting('punch_line1') }}</span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div data-scroll-reveal="ctn" class="logo_symbol ico-48" >
                            <div class="logo w-embed">
                                <svg width="100%" height="100%" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.55544 9.1241C4.81712 7.38578 4.69025 4.69428 4.69025 4.69428C4.69025 4.69428 7.38176 4.82115 9.12007 6.55947C10.8584 8.29779 10.9853 10.9893 10.9853 10.9893C10.9853 10.9893 8.29376 10.8624 6.55544 9.1241Z" fill="currentColor"></path>
                                    <path d="M20 0.00151769L16.1569 8.1194C15.5932 9.31006 15.5931 10.6907 16.1568 11.8814L18.4988 16.8291C17.7735 17.1796 17.1891 17.7755 16.8534 18.5091L11.8814 16.1558C10.6907 15.5923 9.31007 15.5923 8.11946 16.156L0 20V19.177C0 18.3493 0.423339 17.5792 1.12211 17.1356L7.64451 12.9953C9.08249 12.0825 10.9183 12.0824 12.3564 12.9951L14.1067 14.1059L12.9961 12.3565C12.0833 10.9184 12.0833 9.08239 12.9962 7.64431L17.1364 1.12212C17.5799 0.423353 18.3501 1.51793e-05 19.1777 1.51793e-05L20 0.00151769Z"
                                    fill="currentColor"></path>
                                    <path d="M33.4446 30.8759C35.1829 32.6142 35.3097 35.3057 35.3097 35.3057C35.3097 35.3057 32.6182 35.1788 30.8799 33.4405C29.1416 31.7022 29.0147 29.0107 29.0147 29.0107C29.0147 29.0107 31.7062 29.1375 33.4446 30.8759Z" fill="currentColor"></path>
                                    <path d="M20 39.9984L23.8431 31.8806C24.4068 30.6899 24.4069 29.3092 23.8432 28.1185L21.5012 23.1708C22.2265 22.8204 22.8109 22.2244 23.1466 21.4909L28.1186 23.8441C29.3093 24.4077 30.6899 24.4076 31.8805 23.8439L40 19.9999V20.8229C40 21.6506 39.5767 22.4208 38.8779 22.8643L32.3555 27.0047C30.9175 27.9175 29.0817 27.9176 27.6436 27.0049L25.8933 25.894L27.0039 27.6435C27.9167 29.0816 27.9167 30.9176 27.0038 32.3556L22.8636 38.8778C22.4201 39.5766 21.6499 39.9999 20.8223 39.9999L20 39.9984Z"
                                    fill="currentColor"></path>
                                    <path d="M30.8759 6.55544C32.6142 4.81712 35.3057 4.69026 35.3057 4.69026C35.3057 4.69026 35.1789 7.38176 33.4405 9.12008C31.7022 10.8584 29.0107 10.9853 29.0107 10.9853C29.0107 10.9853 29.1376 8.29376 30.8759 6.55544Z" fill="currentColor"></path>
                                    <path d="M39.9985 20L31.8806 16.1569C30.69 15.5932 29.3093 15.5931 28.1186 16.1568L23.1709 18.4988C22.8204 17.7735 22.2245 17.1891 21.4909 16.8534L23.8442 11.8814C24.4078 10.6907 24.4077 9.31007 23.844 8.11946L20 0L20.823 3.59746e-08C21.6507 7.2153e-08 22.4208 0.423339 22.8644 1.12211L27.0047 7.64451C27.9175 9.08249 27.9176 10.9183 27.0049 12.3564L25.8941 14.1067L27.6435 12.9961C29.0816 12.0833 30.9176 12.0833 32.3557 12.9962L38.8779 17.1364C39.5767 17.5799 40 18.3501 40 19.1777L39.9985 20Z"
                                    fill="currentColor"></path>
                                    <path d="M9.12417 33.4445C7.38585 35.1828 4.69435 35.3097 4.69435 35.3097C4.69435 35.3097 4.82122 32.6182 6.55954 30.8799C8.29786 29.1416 10.9894 29.0147 10.9894 29.0147C10.9894 29.0147 10.8625 31.7062 9.12417 33.4445Z" fill="currentColor"></path>
                                    <path d="M0.00159168 20L8.11947 23.8431C9.31013 24.4068 10.6908 24.4068 11.8815 23.8432L16.8292 21.5012C17.1796 22.2265 17.7756 22.8109 18.5092 23.1466L16.1559 28.1186C15.5923 29.3093 15.5924 30.6899 16.1561 31.8805L20.0001 40H19.1771C18.3494 40 17.5793 39.5766 17.1357 38.8779L12.9954 32.3555C12.0825 30.9175 12.0825 29.0816 12.9951 27.6436L14.106 25.8933L12.3566 27.0038C10.9185 27.9167 9.08247 27.9167 7.64438 27.0038L1.1222 22.8636C0.423427 22.42 8.89523e-05 21.6499 8.90608e-05 20.8222L0.00159168 20Z"
                                    fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="info-s_logo_r">
                            <div data-scroll-reveal="p" class="l1 a-center">{{ setting('punch_line2') }}</div>
                        </div>
                    </div>
                    <div class="u-48"></div>
                    <div class="divider">
                        <div data-scroll-reveal="line" class="line-v" ></div>
                    </div>
                    <div class="u-48"></div>
                    <div class="grid">
                        <div class="s_title"><p data-scroll-reveal="p" class="l1 a-center">Since 1997</p></div>
                    </div>
                    <div class="u-96"></div>
                    <div class="benefits-intro-s_title">
                        <div class="benefits-intro-s_title_svg b-desk w-embed">
                            <svg viewBox="0 0 1600 1600" width="100%" height="100%">
                                <defs>
                                    <path id="circle-desk" d="M 800,800 m -676,0 a 676,676 0 1,1 1352,0 a 676,676 0 1,1 -1352,0"></path>
                                </defs>
                                <text data-circle-text="" class="h4" text-anchor="middle" fill="currentColor">
                                    <textPath href="#circle-desk" startOffset="25%">{{ setting('experience_line') }}</textPath>
                                </text>
                            </svg>
                        </div>
                        <div class="benefits-intro-s_title_svg b-mob w-embed">
                            <svg viewBox="0 0 416 416" width="100%" height="100%">
                                <defs>
                                    <path id="circle-mob" d="M 208,208 m -160,0 a 160,160 0 1,1 320,0 a 160,160 0 1,1 -320,0"></path>
                                </defs>
                                <text data-circle-text="" class="h4" text-anchor="middle" fill="currentColor">
                                    <textPath href="#circle-mob" startOffset="25%">{{ setting('experience_line') }}</textPath>
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </section>

    <section data-bg="light" data-snap="" class="section z-2 theme_on-brand" @if(setting('arch_color'))
            style="background-color: {{ setting('arch_color') }}"
        @endif>
        <div class="container">
            <div class="benefits-w">
                <div class="benefits-s">                
                    <div data-slider="" class="benefits-s_cms">
                        <div class="benefits-s_cms_pag">
                            <div class="u-48"></div>
                            <div class="u-16"></div>
                            <div class="benefit-slide_img"></div>
                            <div class="u-16"></div>
                            <div data-scroll-reveal="ctn" data-slider="pag" class="pag" >
                                <div data-slider="prev" class="pag_prev">
                                    <div class="ico-16">
                                        <div class="ico w-embed">
                                            <svg width="100%" height="100%" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.4717 12.4717C10.2113 12.7321 9.78866 12.7321 9.52831 12.4717L5.52831 8.47173C5.26796 8.21138 5.26796 7.78872 5.52831 7.52837L9.52831 3.52837C9.78866 3.26802 10.2113 3.26802 10.4717 3.52837C10.732 3.78872 10.732 4.21138 10.4717 4.47173L6.94335 8.00005L10.4717 11.5284C10.732 11.7887 10.732 12.2114 10.4717 12.4717Z"
                                                fill="currentColor"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="pag_prev_label">
                                        <div data-slider="current" class="l1">3</div>
                                    </div>
                                </div>
                                <div class="pag_progress">
                                    <div data-slider="progress" class="pag_progress_fill" ></div>
                                </div>
                                <div data-slider="next" class="pag_next">
                                    <div class="pag_prev_label">
                                        <div data-slider="next-num" class="l1">1</div>
                                    </div>
                                    <div class="ico-16">
                                        <div class="ico w-embed">
                                            <svg width="100%" height="100%" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.52833 3.52827C5.78868 3.26792 6.21134 3.26792 6.47169 3.52827L10.4717 7.52827C10.732 7.78862 10.732 8.21128 10.4717 8.47163L6.47169 12.4716C6.21134 12.732 5.78868 12.732 5.52833 12.4716C5.26798 12.2113 5.26798 11.7886 5.52833 11.5283L9.05665 7.99995L5.52833 4.47163C5.26798 4.21128 5.26798 3.78862 5.52833 3.52827Z"
                                                fill="currentColor"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="benefits-cms w-dyn-list">
                            <div role="list" class="benefits-cms_list w-dyn-items">
                                @foreach($projects as $value)
                                    <div data-reveal-first="" data-slider="slide" role="listitem" class="benefits-cms_list_item w-dyn-item">
                                        <div class="benefit-slide">
                                            <div class="benefit-slide_t">
                                                <div class="u-24 b-desk"></div>
                                                <div class="u-272 b-mob"></div>
                                                <h4 data-scroll-reveal="h" data-slider="h" class="h3 a-center b-desk">
                                                    {{ $value->title }}
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="benefit-slide_c">
                                            <div class="u-24 b-desk"></div>
                                            <div class="benefit-slide_img">
                                                <div data-slider="img" class="img-w">
                                                    @if($value->image)
                                                        <a href="/apartments">
                                                            <img src="{{ Storage::url($value->image) }}" loading="eager" alt="{{ $value->title }}" sizes="100vw" class="img" >
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="u-48 b-desk"></div>
                                        <div class="u-48 b-desk"></div>

                                        <div class="benefit-slide_b">                                                
                                            <div class="benefit-slide_desc">
                                                <p data-scroll-reveal="p" data-slider="p" class="p1 a-center"><b>Size: {{ $value->area }}</b></p>
                                                <p data-scroll-reveal="p" data-slider="p" class="p1 a-center">Location: {{ $value->location }}</p>
                                            </div>                                                
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gallery end -->

    <section class="section z-2 theme_on-brand">
        <div class="container">
            <div class="quote-w">
                <div class="quote-s b-desk theme_on-color">
                    <div class="grid">
                        <div class="quote-s_c w-clearfix">
                            <div class="grid _4-columns">
                                <div class="quote-s_ico">
                                    <div data-scroll-reveal="ctn" class="ico-48">
                                        <div class="ico w-embed">
                                            <svg width="100%" height="100%" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23.232 30.912C23.232 34.752 20.544 38.208 16.32 38.208C11.328 38.208 5.76 33.984 5.76 22.272C5.76 14.016 9.408 6.14399 19.392 6.14399C19.968 6.14399 23.616 6.336 23.616 7.488C23.616 7.87199 23.424 8.63999 22.656 8.63999C21.888 8.63999 20.928 8.256 19.008 8.256C11.904 8.256 8.64 14.4 8.64 20.928C8.64 23.808 9.984 25.536 12.096 25.536C14.016 25.536 14.592 23.808 17.472 23.808C20.736 23.808 23.232 26.88 23.232 30.912ZM43.2 30.912C43.2 34.752 40.512 38.208 36.096 38.208C31.296 38.208 25.536 33.984 25.536 22.272C25.536 14.016 29.376 6.14399 39.36 6.14399C39.936 6.14399 43.584 6.336 43.584 7.488C43.584 7.87199 43.392 8.63999 42.624 8.63999C41.664 8.63999 40.704 8.256 38.976 8.256C31.68 8.256 28.608 14.4 28.608 20.928C28.608 23.808 29.952 25.536 32.064 25.536C33.984 25.536 34.56 23.808 37.248 23.808C40.704 23.808 43.2 26.88 43.2 30.912Z"
                                                fill="currentColor"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="u-32"></div>
                                </div>
                            </div>
                            <div class="red-line"></div>
                            <h6 data-scroll-reveal="p" data-tab="p" class="h6">
                                <span class="split-line-mask">{{ setting('ceo_message') }}</span>
                            </h6>
                            <div class="u-48"></div>
                            <div class="grid _4-columns">
                                <div class="quote-s_author">
                                    <div data-scroll-reveal="p" class="l1">{{ setting('ceo_name') }}</div>
                                    <div data-scroll-reveal="p" class="l1 reg">CEO</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="u-48"></div>
                </div>
                <div data-parallax="w" class="quote-w_bg">
                    <div class="img-w h-auto quote-w_bg_img">
                        <div class="img-over-grad from-bot bot _4x b-desk"></div>
                        <div class="img-over-grad from-bot bot _4x b-desk"></div>
                        @php
                            $gallery = setting('gallery', []);
                        @endphp                                

                        @if (!empty($gallery))
                            <img loading="eager" alt="" sizes="(max-width: 1920px) 100vw, 1920px" class="img h-auto hero-img"
                                src="{{ Storage::url($gallery['1920'] ?? $gallery['1080'] ?? '') }}"
                                srcset="
                                    @if(isset($gallery['500'])){{ Storage::url($gallery['500']) }} 500w,@endif
                                    @if(isset($gallery['800'])){{ Storage::url($gallery['800']) }} 800w,@endif
                                    @if(isset($gallery['1080'])){{ Storage::url($gallery['1080']) }} 1080w,@endif
                                    @if(isset($gallery['1600'])){{ Storage::url($gallery['1600']) }} 1600w,@endif
                                    @if(isset($gallery['1920'])){{ Storage::url($gallery['1920']) }} 1920w,@endif
                                "
                            />
                        @endif                   
                    </div>
                </div>
                <div class="w_themes">
                    <div class="w_themes_row fill">
                        <div data-bg="color" class="quote-w_themes_color-1"></div>
                        <div data-bg="light" class="quote-w_themes_light-1"></div>
                    </div>
                    <div class="w_themes_row">
                        <div data-bg="color" class="quote-w_themes_color-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CEO message end -->

    <section data-bg="light" data-slow-scroll="" class="section clip">
        <div class="container loc">
            <div data-video-playpause="" data-scroll-horizontal="" class="loc-scroll-area">
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
                                            <h2 data-part="p" class="l1 a-center">Our Journey</h2>
                                        </div>
                                    </div>
                                    <div class="u-24 b-desk"></div>
                                    <div class="u-160 b-mob"></div>
                                    <div class="grid">
                                        <div class="info-s_lead">
                                            <h3 class="h3 a-center">Timeline</h3>
                                        </div>
                                    </div>
                                    <div class="u-24 b-desk"></div>
                                    <div class="u-48 b-mob"></div>
                                    <div class="grid">
                                        <div class="s_title">
                                            <h2 data-part="p" class="l1 a-center">Since 1997</h2>
                                        </div>
                                        <div class="u-24 b-desk"></div>                                    
                                    </div>                                
                                </div>                            
                                
                                <div class="loc-info-s_b">
                                    <div class="grid">
                                        <div class="info-s_desc">                                        
                                            <div class="u-32"></div>
                                            <div class="s_logo">
                                                <div data-part="ctn" class="logo_symbol ico-48" >
                                                    <div class="logo w-embed">
                                                        @include('parts.flowers.flower')                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="u-48"></div>
                                </div>
                            </div>
                            <div data-parallax="ctn-down" class="flower loc-info" >
                                @include('parts.flowers.flower_lt')
                            </div>
                        </div>

                        <div class="loc-intro-w">
                            <div class="loc-intro-s">
                                <div class="u-24 b-desk"></div>
                                <div class="u-160 b-mob"></div>
                                <div class="grid _13-columns fill">                                            
                                    <div class="loc-intro-s_title">
                                        <h2 data-scroll-reveal="h" class="h2">Our <br />Journey</h2>
                                    </div>
                                    <div class="loc-intro-s_img">
                                        <div class="u-32 b-mob"></div>
                                            <div class="u-24"></div>                                                    
                                            <div class="other-cms w-dyn-list">
                                                <div class="timeline-wrapper">                                        
                                                    <button type="button" class="timeline-nav timeline-prev" aria-label="Previous year">
                                                        &#10094;
                                                    </button>
                                                    
                                                    <div class="timeline-years-wrap">
                                                        <div class="timeline-years">
                                                            @foreach($timelines as $index => $timeline)
                                                                <div class="timeline-year {{ $index === 0 ? 'is-active' : '' }}" data-index="{{ $index }}" >
                                                                    <h5 class="h5">{{ $timeline->year }}</h5>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <button type="button" class="timeline-nav timeline-next" aria-label="Next year">
                                                        &#10095;
                                                    </button>

                                                    <div class="timeline-content">
                                                        @foreach($timelines as $index => $timeline)
                                                            <div class="timeline-item {{ $index === 0 ? 'is-active' : '' }}" data-index="{{ $index }}" >
                                                                <div class="timeline-image">
                                                                    @if($timeline->image)                                                                                                                                   
                                                                        <img src="{{ Storage::url($timeline->image) }}" alt="{{ $timeline->title }}" class="big-img" />                                                                
                                                                    @endif
                                                                </div>

                                                                <div class="timeline-info">
                                                                    <h5 class="h5">{{ $timeline->title }}</h5>
                                                                    <p>{!! $timeline->description !!}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>                                                                    
                                            </div>                                                    
                                        </div>                                
                                    </div>
                                    <div class="u-48"></div>
                                    <div class="flower loc-intro">
                                        @include('parts.flowers.flower_lb')                                     
                                    </div>

                                    <div class="loc-path-w_flower">
                                        <div class="flower loc-path">
                                            @include('parts.flowers.flower_rt2')
                                        </div>
                                    </div>
                                </div>                                                
                            </div> 
                        
                        <!-- <div class="loc-path-w">
                            <div class="loc-path-s">
                                <div class="loc-path-s_t">
                                    <div class="u-48 b-desk"></div>
                                    <div class="u-160 b-mob"></div>
                                </div>

                                <div class="flower loc-intro">
                                    @include('parts.flowers.flower_lb')
                                </div>                                                     
                                <div class="loc-path-w_flower">
                                    <div class="flower loc-path">
                                        @include('parts.flowers.flower_rt2')
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
                <div data-slow-scroll="" class="slow-scroll-trigger"></div>
            </div>
        </div>
    </section>
    <!-- Timeline end -->

    <section data-bg="color" class="section theme_on-color">
        <div data-footer-clip="" class="container" >
            <div class="cta-w">
                <div class="cta-s">
                    <div class="u-272"></div>
                    <div class="grid">
                        <div class="cta-s_title">
                            <h2 data-scroll-reveal="h" class="h3 a-center">Why <br />Choose us</h2>                        
                            <div class="u-48"></div>
                            <div data-scroll-reveal="ctn" class="cta-s_title_btn" >
                                <div hover-btn-circle="" data-magnetic-btn="" hover-nav-item-trigger="" class="btn-circle">
                                    <div data-magnetic-inner="" class="btn-circle_label">
                                        <a hover-nav-item="" href="apartments" class="nav-item w-inline-block">
                                            <div class="nav-item_label">
                                                <div class="nav-item_label_text">
                                                    <div hover="text" class="l1">Completed <br />Projects</div>
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
                                    <a href="apartments" class="btn-circle_link w-inline-block"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w_bg">
                    <div data-parallax="w" class="img-w mukesh">
                        @php
                            $why = setting('why', []);
                        @endphp                                

                        @if (!empty($why))
                            <img loading="eager" alt="" sizes="(max-width: 1920px) 100vw, 1920px" class="img-p"
                                src="{{ Storage::url($why['1920'] ?? $why['1080'] ?? '') }}"
                                srcset="
                                    @if(isset($why['500'])){{ Storage::url($why['500']) }} 500w,@endif
                                    @if(isset($why['800'])){{ Storage::url($why['800']) }} 800w,@endif
                                    @if(isset($why['1080'])){{ Storage::url($why['1080']) }} 1080w,@endif
                                    @if(isset($why['1600'])){{ Storage::url($why['1600']) }} 1600w,@endif
                                    @if(isset($why['1920'])){{ Storage::url($why['1920']) }} 1920w,@endif
                                "
                            />
                        @endif                   
                        <div class="img-over-grad from-top _4x"></div>
                        <div class="img-over-grad"></div>
                        <div class="img-over-grad"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose section end -->
</main>

@endsection