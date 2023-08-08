<?php foreach($cars as $car): 
    $car_data = $car->params;
?>

<article class="result card">
    <section class="result-header">
        <div class="result-basic-info">
            <h3 class="tds-text--h4"><span><?= $car['year'] ?></span> <span><?= $car['modelName'] ?></span></h3>
            <?php if($car['modification']): ?>
                <div class="tds-text_color--10">Модификация: <?= $car['modificationName'] ?></div>
            <?php endif; ?>
            <div class="tds-text__status">Статус: В пути</div>
        </div> 
        <div class="result-pricing">
            <div class="result-price"><span class="result-purchase-price tds-text--h4"><?= number_format((int)$car['cash_rub'], 0, '.', ' ') ?> руб</span></div>
            <div class="result-loan-payment tds-text--headline_color">
                <?= number_format((int)$car['cash_usd'], 0, '.', ' ') ?> $
                 
            </div> 
        </div>
    </section>
    <section class="result-gallery">
        <div class="result-photos-main">
            <ul class="result-photos-slides">
                <?php 
                    $files = [];
                    $path = './../web/img/katalog/'.$car['model'].'/body/'.$car['body_color'].'/';
                    $img_path = '/img/katalog/'.$car['model'].'/body/'.$car['body_color'].'/';
                    $total_body_photos = 0;

                    if(is_dir($path)) {
                        $files_body = array_diff(scandir($path), array('.', '..'));
                        if(!empty($files_body)) {
                            foreach ($files_body as $fbody) {
                                $files[] = $img_path.$fbody;
                            }
                        }

                        $total_body_photos = count($files_body);
                    }

                    $path = './../web/img/katalog/'.$car['model'].'/interior/'.$car['interior_color'].'/';
                    $img_path = '/img/katalog/'.$car['model'].'/interior/'.$car['interior_color'].'/';
                    if(is_dir($path)) {
                        $files_interior = array_diff(scandir($path), array('.', '..'));
                        if(!empty($files_body)) {
                            foreach ($files_interior as $fint) {
                                $files[] = $img_path.$fint;
                            }
                        }                                        ;
                    }
                    
                    $i = 1;
                    foreach($files as $file):
                ?>
                <li class="result-photos-slide idp--js-carousel_slide photo-<?= $i ?> result-photos-slide <?= $i == 1 ? 'result-photos-slide--active' : '' ?>" style="transition: all 300ms ease 0s; transform: translateX(0%);">
                    <div class="result-image-container model-m3 view-frontView">
                        <div class="fallback-image-container">
                            <img
                                src="data:image/jpeg;base64,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"
                                class="result-image tiny fallback"
                                alt="Used Inventory Front View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                            />
                        </div>
                        <div class="LazyLoad is-visible lazy-load-container">
                            <img
                                src="<?= $file ?>"
                                class="result-image full <?= $i <= $total_body_photos ? 'image-full' : '' ?>"
                                alt="Used Inventory Front View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                            />
                        </div>
                    </div>
                </li>
                <?php
                    $i++; 
                    endforeach;
                ?>
                <?php 
                    if(!empty($car->carImages)): 
                        foreach ($car->carImages as $image):
                ?>
                    <li class="result-photos-slide idp--js-carousel_slide photo-<?= $i ?> result-photos-slide <?= $i == 1 ? 'result-photos-slide--active' : '' ?>" style="transition: all 300ms ease 0s; transform: translateX(0%);">
                        <div class="result-image-container model-m3 view-frontView">
                            <div class="fallback-image-container">
                                <img
                                    src="data:image/jpeg;base64,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"
                                    class="result-image tiny fallback"
                                    alt="Used Inventory Front View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                                />
                            </div>
                            <div class="LazyLoad is-visible lazy-load-container">
                                <img
                                    src="/uploads/<?= $image->filename ?>"
                                    class="result-image full <?= $i <= $total_body_photos ? 'image-full' : '' ?>"
                                    alt="Used Inventory Front View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                                />
                            </div>
                        </div>
                    </li>
                <?php
                        $i++;
                        endforeach;
                    endif; 
                ?>
                <!-- <li class="result-photos-slide idp--js-carousel_slide photo-2 result-photos-slide--next result-photos-slide--prev" style="transition: all 300ms ease 0s; transform: translateX(0%);">
                    <div class="result-image-container model-m3 view-interiorView">
                        <div class="fallback-image-container">
                            <img
                                src="data:image/jpeg;base64,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"
                                class="result-image tiny fallback"
                                alt="Used Inventory Interior View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                            />
                        </div>
                        <div class="LazyLoad is-visible lazy-load-container">
                            <img
                                src="https://static-assets.tesla.com/configurator/compositor?&amp;bkba_opt=2&amp;view=STUD_SEAT&amp;size=1400&amp;model=m3&amp;options=$APBS,$DV2W,$IN3BB,$PMNG,$PRM30,$SC04,$MDL3,$W38B,$MT301,$CPF0,$RSF1&amp;crop=1400,850,300,130&amp;"
                                class="result-image full"
                                alt="Used Inventory Interior View of Model 3 Standard Range Plus Rear-Wheel Drive Edition"
                            />
                        </div>
                    </div>
                </li> -->
            </ul>
            <div class="result-photos_controls result-photos-controls result-photos-navigation idp--js-carousel-navigation result-photos-navigation--dotted">
                <button type="button" class="result-photos-arrow result-photos-arrow--previous" aria-label="Previous Slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <title id="Previous Slide">Previous Slide</title>
                        <g fill="none" fill-rule="evenodd" stroke="#FFF" transform="rotate(-180 16 16)">
                            <rect width="30" height="30" x="1" y="1" fill="#000" fill-opacity=".5" stroke-width="2" rx="6"></rect>
                            <path
                                fill="#FFF"
                                fill-rule="nonzero"
                                d="M14.448 12.871a.932.932 0 0 1 0-1.231.745.745 0 0 1 1.122 0l3.582 3.929c.31.34.31.891 0 1.231l-3.582 3.93a.745.745 0 0 1-1.122 0 .932.932 0 0 1 0-1.232l3.02-3.313-3.02-3.314z"
                            ></path>
                        </g>
                    </svg>
                    <span class="tds--is_visually_hidden">Previous Slide</span>
                </button>
                <button type="button" class="result-photos-arrow result-photos-arrow--next" aria-label="Next Slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <title id="Next Slide">Next Slide</title>
                        <g fill="none" fill-rule="evenodd" stroke="#FFF">
                            <rect width="30" height="30" x="1" y="1" fill="#000" fill-opacity=".5" stroke-width="2" rx="6"></rect>
                            <path
                                fill="#FFF"
                                fill-rule="nonzero"
                                d="M14.448 12.871a.932.932 0 0 1 0-1.231.745.745 0 0 1 1.122 0l3.582 3.929c.31.34.31.891 0 1.231l-3.582 3.93a.745.745 0 0 1-1.122 0 .932.932 0 0 1 0-1.232l3.02-3.313-3.02-3.314z"
                            ></path>
                        </g>
                    </svg>
                    <span class="tds--is_visually_hidden">Next Slide</span>
                </button>
            </div>
        </div>
    </section>
    <section class="result-features"></section>
    <section class="result-highlights-cta">
        <div class="result-cta-btns"><a href="/feature/<?= $car->id ?>"type="button" tabindex="" class="result-view-details-btn tds-btn tds-btn--secondary">Подробнее</a></div>
        <div class="result-highlights">
            <ul class="highlights-list">
                <li>
                    <div><span class="tds-text--h4"><?= $car_data['acceleration'] ?></span> <span>сек</span></div>
                    <div class="tds-text--caption"><span>0-100 км/ч</span></div>
                </li>
                <li>
                    <div><span class="tds-text--h4"><?= $car_data['max_speed'] ?></span> <span>км/ч</span></div>
                    <div class="tds-text--caption"><span>Макс. скорость</span></div>
                </li>
                <li>
                    <div><span class="tds-text--h4"><?= $car_data['distance'] ?> </span> <span>км</span></div>
                    <div class="tds-text--caption"><span>Запас хода</span></div>
                </li>
            </ul>
        </div>
    </section>
    <section class="result-features">
        <div class="result-features_wrap">
            <div class="result-features__item">
                <div class="result-features__item_text">Кузов</div>
                <div class="result-features__item_icon"><img src="/img/filter/filter/paint/<?= $car['body_color'] ?>.png" alt="Кузов"></div>
                <div class="result-features__item_text"><?= $car['bodyColorName'] ?></div>
            </div>
            <div class="result-features__item">
                <div class="result-features__item_text">Интерьер</div>
                <div class="result-features__item_icon"><img src="/img/filter/filter/Interior/<?= $car['interior_color'] ?>.png" alt="Интерьер"></div>
                <div class="result-features__item_text"><?= $car['interiorColorName'] ?></div>
            </div>
            <div class="result-features__item">
                <div class="result-features__item_text">Диски</div>
                <div class="result-features__item_icon"><img src="img/filter/filter/wheels/tempest.png" alt="Диски"></div>
                <div class="result-features__item_text">20”</div>
            </div>
        </div>
    </section>
    <section class="result-mobile-cta">

        <?php 
            $sell_types = [];
            
            if(!empty($car['leasing_usd'])) {
                $sell_types[] = 'в лизинг';
            }

            if(!empty($car['price_usd'])) {
                if(!empty($sell_types)) {
                    $sell_types[] = 'безналичный расчет';
                } else {
                    $sell_types[] = 'за безналичный расчет';
                }
            }

            if(!empty($sell_types)): 
        ?>
            <div class="result-cta-btns">*возможна покупка <?= implode($sell_types, ' и ') ?></div>
        <?php endif; ?>
    </section>
    <section class="result-disclaimers"></section>
</article>
<?php endforeach; ?>