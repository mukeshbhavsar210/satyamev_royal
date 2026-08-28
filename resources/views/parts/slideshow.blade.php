<div class="amen-scroll-area">
    <div class="scroll-area_screen">
        <section class="section clip theme_on-color">
            <div class="container">
                <div class="amen-w" >
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
                                    <div data-reveal-first="" data-tab-content="gated-community" role="listitem" class="amen-cms_list_item w-dyn-item is-active" >
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
                                                            <span class="split-line-mask"  >
                                                                <span class="split-line"  >
                                                                    <span class="split-word" >Instead</span> <span class="split-word" >of</span> <span class="split-word" >corridors,</span> <span class="split-word" >walking</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >paths</span> <span class="split-word" >connect</span> <span class="split-word" >the</span> <span class="split-word" >apartments</span> <span class="split-word" >—</span> <span class="split-word" >making</span> <span class="split-word" >Era</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Residence</span> <span class="split-word" >feel</span> <span class="split-word" >closer</span> <span class="split-word" >to</span> <span class="split-word" >a</span> <span class="split-word" >group</span> <span class="split-word" >of</span> <span class="split-word" >private</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >homes</span> <span class="split-word" >than</span> <span class="split-word" >a</span> 
                                                                    <span class="split-word" >standard</span></span>
                                                                </span>
                                                            </h4>
                                                    </div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" >
                                                    <div class="img-w" >
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
                                    <div data-reveal-first="" data-tab-content="swimming-pool-2" role="listitem" class="amen-cms_list_item w-dyn-item" >
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Swimming Pool"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Swimming</span> <span class="split-word" >Pool</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Saltwater swimming pool, Children’s pool, Sauna, jacuzzi and wellness shower"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Saltwater</span> <span class="split-word" >swimming</span> <span class="split-word" >pool,</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Children’s</span> <span class="split-word" >pool,</span> <span class="split-word" >Sauna,</span> <span class="split-word" >jacuzzi</span> <span class="split-word" >and</span> <span class="split-word" >wellness</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >shower</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" >
                                                    <div class="img-w" >
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-500.webp 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-800.webp 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-1080.webp 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool-p-1600.webp 1600w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151264dc1dcca76fda17d9_era-residence-pool.webp 1920w"
                                                        class="img-p" ></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="swimming-pool" role="listitem" class="amen-cms_list_item w-dyn-item" >
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Parking area"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Parking</span> <span class="split-word" >area</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Each parking space includes pre-installation for optional EV charging."><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Each</span> <span class="split-word" >parking</span> <span class="split-word" >space</span> <span class="split-word" >includes</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >pre-installation</span> <span class="split-word" >for</span> <span class="split-word" >optional</span> <span class="split-word" >EV</span> <span class="split-word" >charging.</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" >
                                                    <div class="img-w" >
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking-p-500.png 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking-p-800.png 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a1573fc640c344ee0705819_era-residence-parking.webp 1920w"
                                                        class="img-p" ></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="spa-gym" role="listitem" class="amen-cms_list_item w-dyn-item" >
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Spa &amp; gym"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Spa</span> <span class="split-word" >&amp;</span> <span class="split-word" >gym</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="Designed exclusively for residents and their guests, the amenities at ERA encourage a slower and more balanced Mediterranean lifestyle"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Designed</span> <span class="split-word" >exclusively</span> <span class="split-word" >for</span> <span class="split-word" >residents</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >and</span> <span class="split-word" >their</span> <span class="split-word" >guests,</span> <span class="split-word" >the</span> <span class="split-word" >amenities</span> <span class="split-word" >at</span> <span class="split-word" >ERA</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >encourage</span> <span class="split-word" >a</span> <span class="split-word" >slower</span> <span class="split-word" >and</span> <span class="split-word" >more</span> <span class="split-word" >balanced</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Mediterranean</span> <span class="split-word" >lifestyle</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" >
                                                    <div class="img-w" >
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-500.webp 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-800.webp 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-1080.webp 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym-p-1600.webp 1600w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a15132fe66907986a254201_era-residence-spa-%26-gym.webp 1920w"
                                                        class="img-p" ></div>
                                                    <div class="img-over-grad from-top"></div>
                                                    <div class="img-over-grad from-bot _4x bot"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-reveal-first="" data-tab-content="landscaping" role="listitem" class="amen-cms_list_item w-dyn-item" >
                                        <div data-parallax="w" class="amen-slide">
                                            <div class="amen-slide_b">
                                                <div class="grid">
                                                    <div class="amen-slide_title">
                                                        <h3 data-tab="p" class="l1" aria-label="Landscaping"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Landscaping</span></span></span></h3>
                                                        <div class="u-32"></div>
                                                    </div>
                                                    <div class="amen-slide_desc w-clearfix">
                                                        <div class="red-line"></div>
                                                        <h4 data-tab="p" class="h5" aria-label="The landscaping concept was designed to soften the architecture and strengthen the connection between the residences and the Mediterranean environment."><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >The</span> <span class="split-word" >landscaping</span> <span class="split-word" >concept</span> <span class="split-word" >was</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >designed</span> <span class="split-word" >to</span> <span class="split-word" >soften</span> <span class="split-word" >the</span> <span class="split-word" >architecture</span> <span class="split-word" >and</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >strengthen</span> <span class="split-word" >the</span> <span class="split-word" >connection</span> <span class="split-word" >between</span> <span class="split-word" >the</span> </span></span><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >residences</span> <span class="split-word" >and</span> <span class="split-word" >the</span> <span class="split-word" >Mediterranean</span> <span class="split-word" >environment.</span></span></span></h4></div>
                                                </div>
                                                <div class="u-48"></div>
                                            </div>
                                            <div class="amen-slide_img">
                                                <div data-tab="slide" class="img-w" >
                                                    <div class="img-w" >
                                                        <img data-parallax="img-in" loading="eager" alt="" src="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping.webp" sizes="100vw" srcset="https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-500.png 500w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-800.png 800w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping-p-1080.png 1080w, https://cdn.prod.website-files.com/6a0853d5dab31b18f0677081/6a151382fb101ce2ca9db288_era-residence-landscaping.webp 1920w"
                                                        class="img-p" ></div>
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
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Gated community"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Gated</span>                                                            <span class="split-word" >community</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="swimming-pool-2" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Swimming Pool"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Swimming</span>                                                            <span class="split-word" >Pool</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="swimming-pool" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Parking area"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Parking</span>                                                            <span class="split-word" >area</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="spa-gym" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Spa &amp; gym"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Spa</span>                                                            <span class="split-word" >&amp;</span> <span class="split-word" >gym</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                    <div data-tab="" data-tab-trigger="landscaping" class="amen-tab">
                                                        <div data-scroll-reveal="p" class="h5"  aria-label="Landscaping"><span class="split-line-mask"  ><span class="split-line"  ><span class="split-word" >Landscaping</span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-scroll-reveal="line" class="amm-s_cms_tabs_line" >
                                            <div data-tab-hilight="" class="amm-s_cms_tabs_line_hilight" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amm-s_cms_btn-w b-desk">
                                <div class="grid">
                                    <div data-scroll-reveal="ctn" class="amm-s_cms_btn" >
                                        <div data-modal-cta-btn="book-a-call" data-magnetic-btn="" hover-nav-item-trigger="" hover-btn-circle="" class="btn-circle">
                                            <div data-magnetic-inner="" class="btn-circle_label">
                                                <a hover-nav-item="" aria-label="Book a call now" href="#" class="nav-item w-inline-block">
                                                    <div class="nav-item_label">
                                                        <div class="nav-item_label_text">
                                                            <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask"  ><span class="split-word" ><span class="split-char" >B</span><span class="split-char"
                                                                >o</span><span class="split-char" >o</span><span class="split-char" >k</span></span>
                                                                </span> <span class="split-word-mask"  ><span class="split-word" ><span class="split-char" >a</span></span>
                                                                </span> <span class="split-word-mask"  ><span class="split-word" ><span class="split-char" >c</span><span class="split-char"
                                                                >a</span><span class="split-char" >l</span><span class="split-char" >l</span></span>
                                                                </span> <span class="split-word-mask"  ><span class="split-word" ><span class="split-char" >n</span><span class="split-char"
                                                                >o</span><span class="split-char" >w</span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="nav-item_label_text is-2">
                                                            <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask"  ><span class="split-word" ><span class="split-char"  >B</span>
                                                                <span
                                                                class="split-char"  >o</span><span class="split-char"  >o</span><span class="split-char" 
                                                                    >k</span></span>
                                                                    </span> <span class="split-word-mask"  ><span class="split-word" ><span class="split-char"  >a</span></span>
                                                                    </span>
                                                                    <span class="split-word-mask"  ><span class="split-word" ><span class="split-char"  >c</span>
                                                                    <span
                                                                    class="split-char"  >a</span><span class="split-char"  >l</span><span class="split-char" 
                                                                        >l</span></span>
                                                                        </span> <span class="split-word-mask"  ><span class="split-word" ><span class="split-char"  >n</span>
                                                                        <span
                                                                        class="split-char"  >o</span><span class="split-char"  >w</span></span>
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