<div class="amen-scroll-area">
    <div class="scroll-area_screen">
        <section class="section clip ">                            
            <div class="amen-s">
                <div data-tabs-hilight="ver" data-tabs="" class="amen-s_cms">
                    <div class="amen-cms w-dyn-list" >
                        <?php
                            $amenities = [
                                [
                                    'tab' => 'gated-community',
                                    'title' => 'Gated Community',
                                    'desc' => 'Gallery 1',
                                    'image' => 'assets/images/big_gallery/gated-community.webp'
                                ],
                                [
                                    'tab' => 'swimming-pool-2',
                                    'title' => 'Swimming Pool',
                                    'desc' => 'Gallery 2',
                                    'image' => 'assets/images/big_gallery/pool.webp'
                                ],
                                [
                                    'tab' => 'parking',
                                    'title' => 'Parking Area',
                                    'desc' => 'Gallery 3',
                                    'image' => 'assets/images/big_gallery/parking.webp'
                                ],
                                [
                                    'tab' => 'spa-gym',
                                    'title' => 'Spa & Gym',
                                    'desc' => 'Gallery 4',
                                    'image' => 'assets/images/big_gallery/spa-gym.webp'
                                ],
                                [
                                    'tab' => 'landscaping',
                                    'title' => 'Landscaping',
                                    'desc' => 'Gallery 5',
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
                    </div>
                    <div class="amm-s_cms_tabs-w">
                        <div class="grid">
                            <div class="amm-s_cms_tabs">
                                <div class="amen-tabs-cms w-dyn-list">
                                    <div role="list" class="amen-tabs-cms_list w-dyn-items">
                                        <?php foreach ($amenities as $index => $item): ?>
                                            <div role="listitem" class="amen-tabs-cms_list_item w-dyn-item">
                                                <div data-tab="" data-tab-trigger="<?= htmlspecialchars($item['tab']); ?>" class="amen-tab">
                                                    <div data-scroll-reveal="p" class="h5">
                                                        <span class="split-line-mask">
                                                            <span class="split-line">
                                                                <?= htmlspecialchars($item['title']); ?>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
                                                    <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" ><span class="split-word" ><span class="split-char" >B</span><span class="split-char"
                                                        >o</span><span class="split-char" >o</span><span class="split-char" >k</span></span>
                                                        </span> <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >a</span></span>
                                                        </span> <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >c</span><span class="split-char"
                                                        >a</span><span class="split-char" >l</span><span class="split-char" >l</span></span>
                                                        </span> <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >n</span><span class="split-char"
                                                        >o</span><span class="split-char" >w</span></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="nav-item_label_text is-2">
                                                    <div hover="text" class="l1" aria-label="Book a call now"><span class="split-word-mask" ><span class="split-word" ><span class="split-char" >B</span>
                                                        <span
                                                        class="split-char" >o</span><span class="split-char" >o</span><span class="split-char" 
                                                            >k</span></span>
                                                            </span> <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >a</span></span>
                                                            </span>
                                                            <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >c</span>
                                                            <span
                                                            class="split-char" >a</span><span class="split-char" >l</span><span class="split-char" 
                                                                >l</span></span>
                                                                </span> <span class="split-word-mask" ><span class="split-word" ><span class="split-char" >n</span>
                                                                <span
                                                                class="split-char" >o</span><span class="split-char" >w</span></span>
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
        </section>
    </div>    
</div>