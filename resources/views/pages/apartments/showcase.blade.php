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
                                @php
                                    $showcase = setting('showcase', []);
                                @endphp

                                @if (!empty($showcase))
                                    <img loading="eager" alt="Showcase" sizes="(max-width: 1920px) 100vw, 1920px" class="img-p"
                                        src="{{ Storage::url($showcase['1920'] ?? $showcase['1080'] ?? '') }}"
                                        srcset="
                                            @if(isset($showcase['500'])){{ Storage::url($showcase['500']) }} 500w,@endif
                                            @if(isset($showcase['800'])){{ Storage::url($showcase['800']) }} 800w,@endif
                                            @if(isset($showcase['1080'])){{ Storage::url($showcase['1080']) }} 1080w,@endif
                                            @if(isset($showcase['1600'])){{ Storage::url($showcase['1600']) }} 1600w,@endif
                                            @if(isset($showcase['1920'])){{ Storage::url($showcase['1920']) }} 1920w,@endif
                                        "
                                    />
                                @endif                                 
                            </div>
                            <div class="img-over-grad from-top"></div>
                            <div class="img-over-grad from-bot _4x bot"></div>
                          </div>
                        </div>
                      </div>
                    </div>                   
                  </div>
                </div>
                
                <div class="amm-s_cms_btn-w b-desk">
                  <div class="grid">
                    <div data-scroll-reveal="ctn" class="amm-s_cms_btn" >
                      <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                        <div data-magnetic-inner="" class="btn-circle_label">
                          <a hover-nav-item="" href="#" class="nav-item w-inline-block">
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
                        <a href="#" class="btn-circle_link w-inline-block"></a>
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