<section data-bg="color" class="section clip theme_on-color">
    <div class="container">
        <div data-parallax="w" class="loc-w">
            <div class="loc-w_over-grad"></div>
            <div class="loc-w_over-grad"></div>
            
            <?php
                $clouds = [
                    [
                        'src' => 'assets/images/clouds/clouds1.avif',
                        'srcset' => 'assets/images/clouds/clouds_5001.avif 500w, assets/images/clouds/clouds_21461.avif 2146w',
                        'sizes' => '(max-width: 2146px) 100vw, 2146px',
                        'class' => 'is-33',
                        'lists' => [3, 2],
                    ],
                    [
                        'src' => 'assets/images/clouds/clouds_47.avif',
                        'srcset' => '',
                        'sizes' => '',
                        'class' => 'is-47',
                        'lists' => [2, 2],
                    ],
                    [
                        'src' => 'assets/images/clouds/clouds_02.avif',
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
                                            <img src="<?= $cloud['src']; ?>" loading="eager" alt=""
                                                class="clouds <?= $cloud['class']; ?>"
                                                <?php if (!empty($cloud['srcset'])): ?>
                                                    sizes="<?= $cloud['sizes']; ?>"
                                                    srcset="<?= $cloud['srcset']; ?>"
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

            <div data-parallax="img" class="loc-w_bg" >
                <div class="loc-w_bg_img" >
                    <div class="pins-cms w-dyn-list">
                        <div class="cms_empty-none w-dyn-empty"></div>
                    </div>
                    <div class="img-w h-auto">
                        <img src="assets/images/clouds/master-plan.webp" 
                        loading="eager" sizes="(max-width: 1920px) 100vw, 1920px" 
                        srcset="assets/images/clouds/master-plan-500.png 500w, 
                        assets/images/clouds/master-plan-800.png 800w, 
                        assets/images/clouds/master-plan-1080.png 1080w, 
                        assets/images/clouds/master-plan.webp 1920w"
                        alt="" class="img h-auto">
                        <div class="img-over-grad from-bot bot _100vh"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>