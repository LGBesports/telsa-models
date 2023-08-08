<?php
  $model_name = str_replace('_', '-',$car->model);
  
  $car_data = $car->params;
?>
<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <title><?= $car->modelName ?></title><!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE = edge"><![endif]-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="color-theme" content="">
    <link type="image/x-icon" rel="shortcut icon" href="/img/fav/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/filter.min.css"><!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script><![endif]-->
  </head>
  <body class="model">
    <div class="wrapper">
      <header class="header"><a class="header__logo logo" href="/"> <img src="/img/logo.svg" alt="Tesla by Autotraider"></a>
        <div class="sandwich">  
          <svg class="svg-sprite-icon  icon-burger sandwich__icon">
            <use xlink:href="/img/svg/sprite.svg#burger"></use>
          </svg>
        </div>
      </header>
      <main class="content">
        <div class="detailsCar modelPrices">
          <div class="detailsCar__inner"> 
            <div class="detailsCar__slider">
              <div class="swiper swiperModel">
                <div class="swiper-wrapper swiperModel__inner">
                  <?php for($i=1; $i<=4; $i++): ?>
                    <div class="swiper-slide swiperModel__slide"><img src="/img/filter/<?= $model_name ?>/wheels/type1/Interior/<?= $car->interior_color ?>/<?= $car->body_color ?>/<?= $i ?>.jpg" alt="Slide"></div>
                  <?php endfor; ?>
                  <div class="swiper-slide swiperModel__slide"><img src="/img/filter/<?= $model_name ?>/Interior/<?= $car->interior_color ?>/<?= $car->body_color ?>/5.jpg" alt="Slide"></div>

                </div>
                <div class="swiperDetails__arrows">
                  <div class="swiperDetails__arrow swiperDetails__next">
                    <svg class="svg-sprite-icon  icon-arrow-left swiperDetails__icon">
                      <use xlink:href="/img/svg/sprite.svg#arrow-left"></use>
                    </svg>
                  </div>
                  <div class="swiperDetails__arrow swiperDetails__prev">
                    <svg class="svg-sprite-icon  icon-arrow-right swiperDetails__icon">
                      <use xlink:href="/img/svg/sprite.svg#arrow-right"></use>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="swiperModel__dots"></div>
              <div class="thumbSwiper">
                <div class="thumbSwiper__inner">
                  <?php for($i=1; $i<=4; $i++): ?>
                    <div class="thumbSwiper__item"><img src="/img/filter/<?= $model_name ?>/wheels/type1/Interior/<?= $car->interior_color ?>/<?= $car->body_color ?>/<?= $i ?>.jpg" alt="Slide"></div>
                  <?php endfor; ?>
                  <div class="thumbSwiper__item"><img src="/img/filter/<?= $model_name ?>/Interior/<?= $car->interior_color ?>/<?= $car->body_color ?>/5.jpg" alt="Slide"></div>
                </div>
              </div>
              <div class="openGallery" open-modal-gallery>
                <div class="openGallery__btn">
                  <svg class="svg-sprite-icon  icon-arrow-up openGallery__icon">
                    <use xlink:href="/img/svg/sprite.svg#arrow-up"></use>
                  </svg>
                </div><span>Смотреть фотографии</span>
              </div>
            </div>
            <aside class="detailsCar__info" data-model="start">
              <h1 class="detailsCar__title">
                 <?= $car->year ?> Tesla <?= $car->modelName ?> <?= $car->modificationName ?></h1>
              <div class="modelPrices__list">
                <div class="modelPrices__inner">
                  <div class="modelPrices__item">
                    <?php if($car->cash_usd): ?>
                      <div class="modelPrices__col">Наличный расчет</div>
                    <?php endif; ?>

                    <?php if($car->price_usd): ?>
                      <div class="modelPrices__col">Безнал без НДС</div>
                    <?php endif; ?>

                    <?php if($car->price_nds_usd): ?>
                      <div class="modelPrices__col">Безнал с НДС</div>
                    <?php endif; ?>

                    <?php if($car->leasing_usd): ?>
                      <div class="modelPrices__col">Лизинг</div>
                    <?php endif; ?>

                  </div>
                  <div class="modelPrices__item">
                    <?php if($car->cash_rub): ?>
                      <div class="modelPrices__col"><?= number_format($car->cash_rub, 0, '.', ' ') ?> ₽</div>
                    <?php endif; ?>

                    <?php if($car->price_rub): ?>
                      <div class="modelPrices__col"><?= number_format($car->price_rub, 0, '.', ' ') ?> ₽</div>
                    <?php endif; ?>

                    <?php if($car->price_nds_rub): ?>
                      <div class="modelPrices__col"><?= number_format($car->price_nds_rub, 0, '.', ' ') ?> ₽</div>
                    <?php endif; ?>

                    <?php if($car->leasing_rub): ?>
                      <div class="modelPrices__col"><?= number_format($car->leasing_rub, 0, '.', ' ') ?> ₽</div>
                    <?php endif; ?>
                  </div>
                  <div class="modelPrices__item">
                    <?php if($car->cash_usd): ?>
                      <div class="modelPrices__col"><?= number_format($car->cash_usd, 0, '.', ' ') ?> $</div>
                    <?php endif; ?>

                    <?php if($car->price_usd): ?>
                      <div class="modelPrices__col"><?= number_format($car->price_usd, 0, '.', ' ') ?> $</div>
                    <?php endif; ?>

                    <?php if($car->price_nds_usd): ?>  
                      <div class="modelPrices__col"><?= number_format($car->price_nds_usd, 0, '.', ' ') ?> $</div>
                    <?php endif; ?>

                    <?php if($car->leasing_usd): ?>
                      <div class="modelPrices__col"><?= number_format($car->leasing_usd, 0, '.', ' ') ?> $ / мес</div>
                    <?php endif; ?>
                  </div>
                </div>
                <a href="/presentation?id=<?= $car->id ?>" target="_blank"><button class="modelPrices__btn" type="button">Получить презентацию</button></a>
              </div>
              <ul class="modelOption">
                <li class="modelOption__item">
                  <div class="modelOption__name">Модель</div>
                  <div class="modelOption__value"><?= $car->modelName ?> <?= $car->modificationName ?></div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Год выпуска</div>
                  <div class="modelOption__value"><?= $car->year ?></div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Привод</div>
                  <div class="modelOption__value"><?= $car_data['drive'] ?></div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Мощность</div>
                  <div class="modelOption__value"><?= $car_data['power'] ?> л.с.</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Крутящий момент</div>
                  <div class="modelOption__value"><?= $car_data['spin'] ?> Нм</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Макс. скорость</div>
                  <div class="modelOption__value"><?= $car_data['max_speed'] ?> км/ч</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Разгон до 100 км/ч</div>
                  <div class="modelOption__value"><?= $car_data['acceleration'] ?> сек</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Запас хода</div>
                  <div class="modelOption__value"><?= $car_data['distance'] ?> км</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Батарея</div>
                  <div class="modelOption__value"><?= $car_data['battery'] ?> кВт * ч</div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Автопилот</div>
                  <div class="modelOption__value"><?= $car_data['autopilot'] ?></div>
                </li>
                <li class="modelOption__item">
                  <div class="modelOption__name">Состояние</div>
                  <div class="modelOption__value"><?= mb_strtoupper(mb_substr($car->conditionName, 0, 1)).mb_substr($car->conditionName, 1) ?></div>
                </li>
                <?php if($car->condition == 'used' && $car->milage): ?>
                <li class="modelOption__item">
                  <div class="modelOption__name">Пробег</div>
                  <div class="modelOption__value"><?= $car->milage ?> км</div>
                </li>
                <?php endif; ?>
              </ul>
              <div class="modelDetail" data-model="corps">
                <div class="modelDetail__caption"><img src="/img/filter/filter/paint/<?= $car->body_color ?>.png" alt="Slide"></div>
                <div class="modelDetail__title">Кузов</div>
                <div class="modelDetail__type">
                  <div class="modelDetail__img"><img src="/img/filter/filter/paint/<?= $car->body_color ?>.png" alt="Белый"></div><span><?= $car->bodyColorName ?></span>
                </div>
              </div>
              <div class="modelDetail" data-model="interior">
                <div class="modelDetail__caption"><img src="/img/filter/filter/Interior/<?= $car->interior_color ?>.png" alt="Slide"></div>
                <div class="modelDetail__title">Интерьер</div>
                <div class="modelDetail__type">
                  <div class="modelDetail__img"><img src="/img/filter/filter/Interior/<?= $car->interior_color ?>.png" alt="Черный"></div><span><?= $car->interiorColorName ?></span>
                </div>
              </div>
              <div class="modelDetail" data-model="wheels">
                <div class="modelDetail__caption"><img src="/img/filter/model-3/wheels/type1/Interior/black/white/4.jpg" alt="Slide"></div>
                <div class="modelDetail__title">Диски</div>
                <div class="modelDetail__type">
                  <div class="modelDetail__img"><img src="/img/model/wheels/model3/wheels.png" alt="20”"></div><span><?= $car->disks ?>”</span>
                </div>
              </div>
              <div class="modelMobile">
                <div class="modelMobile__caption"><img src="/img/filter/model-3/wheels/type1/Interior/black/white/1.jpg" alt="Slide"></div>
              </div>
              <div class="modelForm" data-model="form">
                <div class="modelForm__title">Заинтересовал автомобиль?</div>
                <div class="modelForm__text">Получите дополнительные фото и видео данного автомобиля</div>
                <form class="modelForm__form" action="/">
                  <input class="modelForm__input" type="text" name="name" aria-label="name" placeholder="Имя">
                  <input class="modelForm__input" type="tel" name="phone" aria-label="phone" placeholder="+7 999 999 99 99">
                  <input class="modelForm__input" type="text" name="email" aria-label="email" placeholder="e-mail">
                  <div class="modelForm__check"> 
                    <input type="checkbox" checked name="check" id="checkModel">
                    <label for="checkModel">
                      <svg class="svg-sprite-icon  icon-check modelForm__check-icon">
                        <use xlink:href="/img/svg/sprite.svg#check"></use>
                      </svg>Оставляя свои данные вы соглашаетесь с политикой конфиденциальности
                    </label>
                  </div>
                  <button class="modelForm__btn" type="submit">Хочу ещё фото</button>
                </form>
                <div class="socials"><a class="socials__item whatsapp" href="#">
                    <svg class="svg-sprite-icon  icon-whatsapp socials__icon">
                      <use xlink:href="/img/svg/sprite.svg#whatsapp"></use>
                    </svg><span>WhatsApp</span></a><a class="socials__item telegram" href="#">
                    <svg class="svg-sprite-icon  icon-telegram socials__icon">
                      <use xlink:href="/img/svg/sprite.svg#telegram"></use>
                    </svg><span>Telegram</span></a></div>
              </div>
            </aside>
          </div>
        </div>
      </main>
      <footer class="footer"></footer>
    </div>
    <div class="modal-cars">
      <div class="modal-cars__inner"> 
        <div class="swiper modalCars">
          <div class="swiper-wrapper modalCars__inner">
            <?php 
                if(!empty($car->carImages)): 
                    foreach ($car->carImages as $image):
            ?>
              <div class="swiper-slide modalCars__slide"><img src="/uploads/<?= $image->filename ?>" alt="">
                <button class="modalCars__close" type="button" aria-label="close modal">
                  <svg class="svg-sprite-icon  icon-close modalCars__icon">
                    <use xlink:href="/img/svg/sprite.svg#close"></use>
                  </svg>
                </button>
              </div>
            <?php endforeach; endif; ?>
          </div>
          <div class="modalCars__dots"></div>
          <div class="modalCars__arrows">
            <div class="modalCars__arrow modalCars__prev">
              <svg class="svg-sprite-icon icon-arrow-left">
                <use xlink:href="/img/svg/sprite.svg#arrow-left"></use>
              </svg>
            </div>
            <div class="modalCars__arrow modalCars__next">
              <svg class="svg-sprite-icon icon-arrow-right">
                <use xlink:href="/img/svg/sprite.svg#arrow-right"></use>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="overlay"></div>
    <script src="/js/libs.min.js"></script>
    <script src="/js/feature.js"></script>
  </body>
</html>