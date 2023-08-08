<?php
require_once __DIR__.'/../../components/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
// $options = new Options();
// $options->set('isRemoteEnabled', true);
$dompdf = new Dompdf(['isRemoteEnabled' => true, 'chroot' => __DIR__.'/../../web', //'pdfBackend' => 'CPDF',
'fontDir' => __DIR__.'/../../web/pdf_static/fonts',
'defaultPaperSize' => 'a4',
'defaultOrientation' => 'portrait',
'dpi' => 72
]);

$presentation_data = $presentation->params;
$model_name = str_replace('_', '-',$presentation->model);

$footer = 
'<footer class="footer">
	<div class="footer__container">
		<p class="footer__text">
			ООО «Автотрейдер»
		</p>
		<p class="footer__text footer__text--city">
			г. Москва
		</p>
		<p class="footer__text footer__text--bold">
			'.sprintf("%04d", $presentation->id).' / '.date('d.m.Y', $presentation->created_at).'
		</p>
	</div>
</footer>';

$pricing = '';
if($presentation->cash_usd)
$pricing .= 
'<tr>
	<td class="table__bold">
		Наличный расчет
	</td>
	<td>
		'.number_format($presentation->cash_rub, 0, '.', ' ').' ₽
	</td>
	<td>
		'.number_format($presentation->cash_usd, 0, '.', ' ').' $
	</td>
</tr>';

if($presentation->price_usd)
$pricing .= '<tr>
	<td class="table__bold">
		Безнал без НДС
	</td>
	<td>
		'.number_format($presentation->price_rub, 0, '.', ' ').' ₽
	</td>
	<td>
		'.number_format($presentation->price_usd, 0, '.', ' ').' $
	</td>
</tr>';

if($presentation->price_nds_usd)
$pricing .= '<tr>
	<td class="table__bold">
		Безнал с НДС
	</td>
	<td>
		'.number_format($presentation->price_nds_rub, 0, '.', ' ').' ₽
	</td>
	<td>
		'.number_format($presentation->price_nds_usd, 0, '.', ' ').' $
	</td>
</tr>';

if($presentation->leasing_usd)
$pricing .= '<tr>
	<td class="table__bold">
		Лизинг
	</td>
	<td>
		'.number_format($presentation->leasing_rub, 0, '.', ' ').' ₽
	</td>
	<td>
		'.number_format($presentation->leasing_usd, 0, '.', ' ').' $ / мес
	</td>
</tr>';

$options = '';
foreach ($presentation_data['options'] as $option) {
	$options .= '
	<tr>
		<td>
			'.$option.'
		</td>
	</tr>';
}

$dompdf->loadHtml('
<!DOCTYPE html>
<html lang="ru">

<head>
	<title>Главная</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="format-detection" content="telephone=no">
	<style>
		@font-face {
		  font-family: Montserrat;
		  font-display: swap;
		  src: url("pdf_static/fonts/Montserrat-Bold.ttf");
		  font-weight: 700;
		  font-style: normal;
		}
		@font-face {
		  font-family: Montserrat;
		  font-display: swap;
		  src: url("pdf_static/fonts/Montserrat-Regular.ttf");
		  font-weight: 400;
		  font-style: normal;
		}
		html, body {
			width: 595px !important;
			height: 841px !important;
			margin: 0 !important;
			padding: 0 !important;
		}
	</style>
	<link rel="stylesheet" href="pdf_static/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<div class="header__logo">
					<img src="pdf_static/img/logo.png" alt="Logo">
				</div>
				<div class="header__title" style="height: 1.7rem !important;">
					<a href="atr.ru" class="header__link" style="line-height: 1rem !important;">
						www.atr.ru
					</a>
				</div>
			</div>
		</header>
		<main class="page">
			<div class="page__container">
				<h1 class="page__title title">
					<span>Tesla '.$presentation->modelName.'</span> '.$presentation->modificationName.' '.$presentation->year.'
				</h1>
				<div class="page__flex-half">
					<div class="page__flex-left">
						<table class="page__table table">
							<tr>
								<td class="table__bold">
									Модель
								</td>
								<td>
									'.$presentation->modelName.' '.$presentation->modificationName.'
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Год выпуска
								</td>
								<td>
									'.($presentation->year ? $presentation->year : '-').'
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Привод
								</td>
								<td>
									'.$presentation_data['drive'].'
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Мощность
								</td>
								<td>
									'.$presentation_data['power'].' л.с.
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Крутящий момент
								</td>
								<td>
									'.$presentation_data['spin'].' Нм
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Макс. скорость
								</td>
								<td>
									'.$presentation_data['max_speed'].' км/ч
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Разгон до 100 км/ч
								</td>
								<td>
									'.$presentation_data['acceleration'].' сек
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Запас хода
								</td>
								<td>
									'.$presentation_data['distance'].' км
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Батарея
								</td>
								<td>
									'.$presentation_data['battery'].' кВт * ч
								</td>
							</tr>
							<tr>
								<td class="table__bold">
									Автопилот
								</td>
								<td>
									'.$presentation_data['autopilot'].'
								</td>
							</tr>
						</table>
					</div>
					<div class="page__flex-right page__flex-right--fdc">
						<table class="page__table table">
							'.$pricing.'
						</table>
						<div class="page__options" style="position: absolute; top: 6.5rem;">
							<p class="page__options-title title">
								<span>Выбранные опции</span>
							</p>
							<div class="page__options-main" style="margin-top: 2rem !important;">
								<div class="page__options-block">
									<p>
										Кузов
									</p>
									<div class="page__options-img">
										<picture>
											<img src="img/filter/filter/paint/'. $presentation->body_color.'.png" alt="Black">
										</picture>
									</div>
									<p>
										'.mb_strtoupper(mb_substr($presentation->bodyColorName, 0, 1)).mb_substr($presentation->bodyColorName, 1).'
									</p>
								</div>
								<div class="page__options-block">
									<p>
										Интерьер
									</p>
									<div class="page__options-img">
										<picture>	
											<img src="img/filter/filter/Interior/'.$presentation->interior_color.'.png" alt="Black">
										</picture>
									</div>
									<p>
										'.mb_strtoupper(mb_substr($presentation->interiorColorName, 0, 1)).mb_substr($presentation->interiorColorName, 1).'
									</p>
								</div>
								<div class="page__options-block">
									<p>
										Диски
									</p>
									<div class="page__options-img">
										<picture><source srcset="pdf_static/img/options/wheel.webp" type="image/webp"><img src="pdf_static/img/options/wheel.png" alt="Black"></picture>
									</div>
									<p>
										'.$presentation->disks.'”
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="page__model-images">
					<div class="page__model-img" style="height: 220px; overflow: hidden; position: relative;">
						<div class="page__model-img__inner" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0;">
							<picture><img style="max-width: 200%; height: 220%; transform: translate(-20%, -25%);" src="img/filter/'.$model_name.'/wheels/type1/Interior/'.$presentation->interior_color.'/'.$presentation->body_color.'/1.jpg" alt="Tesla"></picture>
						</div>
					</div>
					<div class="page__model-img" style="height: 220px; overflow: hidden; position: relative;">
						<div class="page__model-img__inner" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0;">
							<picture><img style="width: 100%; position: static; object-fit: fit;" src="img/filter/'.$model_name.'/Interior/'.$presentation->interior_color.'/'.$presentation->body_color.'/5.jpg" alt="Inside"></picture>
						</div>
					</div>
				</div>
			</div>
		</main>
		'.$footer.'
	</div>
</body>

</html>



<html lang="ru">
<head>
	<title>Главная</title>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<div class="header__logo">
					<img src="pdf_static/img/logo.png" alt="Logo">
				</div>
				<div class="header__title" style="height: 1.7rem !important;">
					<a href="atr.ru" class="header__link" style="line-height: 1rem !important;">
						www.atr.ru
					</a>
				</div>
			</div>
		</header>
		<main class="page">
			<div class="page__container">
				<div class="page__title title title--flex">
					<h1><span>Model X</span> Plaid 2022</h1>
					<p>Опции</p>
				</div>
				<table class="page__table table">
					'.$options.'
				</table>
			</div>
		</main>
		'.$footer.'
	</div>
</body>

</html>


<html lang="ru">
<head>
	<title>Главная</title>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<div class="header__logo">
					<img src="pdf_static/img/logo.png" alt="Logo">
				</div>
				<div class="header__title" style="height: 1.7rem !important;">
					<a href="atr.ru" class="header__link" style="line-height: 1rem !important;">
						www.atr.ru
					</a>
				</div>
			</div>
		</header>
		<main class="page">
			<div class="page__container">
				<h1 class="page__title title">
					<span>Приложение Tesla</span>
				</h1>
				<p class="page__text">
					Приложение Tesla позволяет владельцам напрямую общаться со своими <br> транспортными средствами влюбое
					время и
					в любом месте.
				</p>
				<div class="page__img">
					<picture><source srcset="pdf_static/img/app/app.webp" type="image/webp"><img src="pdf_static/img/app/app.png" alt="App"></picture>
				</div>
				<div class="page__flex-half page__flex-half--list">
					<div class="page__flex-left" style="position: absolute; left: 0; top: 0; float: none;">
						<ul class="page__ul">
							<li>
								Проверить процесс зарядки в режиме реального
								времени и начать или остановить зарядку
							</li>
							<li>
								Нагреть или охладить машину перед<br> поездкой -
								даже если она в гараже
							</li>
							<li>
								Найти свой автомобиль, когда припаркован<br> по
								миганию фар или звуковому сигналу
							</li>
						</ul>
					</div>
					<div class="page__flex-right" style="position: absolute; right: 0; top: 0; display: block;">
						<ul class="page__ul">
							<li>
								Удаленно блокировать или разблокировать
							</li>
							<li>
								Обновлять программное обеспечение
							</li>
							<li>
								Вызвать свой автомобиль из гаража<br> или
								ограниченного места для парковки<br> (для
								автомобилей с автопилотом)
							</li>
						</ul>
					</div>
				</div>
				<div class="page__info page__flex-half">
					<div class="page__flex-left page__flex-left--relative" style="position: absolute; top: 3.6rem;">
						<div class="page__circle-text-block">
							<p>
								контактное лицо
							</p>
							<p class="page__circle-name">
								Владимир <br>
								Хацкевич
							</p>
							<p>
								эксперт <br>
								компании
							</p>
						</div>
						<div class="page__circle circle">
							<div class="circle__main-img">
								<picture><source srcset="pdf_static/img/app/person.webp" type="image/webp"><img src="pdf_static/img/app/person.png" alt="Person"></picture>
							</div>
							<div class="circle__inner">
								<div class="circle__img">
									<picture><source srcset="pdf_static/img/app/person.webp" type="image/webp"><img src="pdf_static/img/app/person.png" alt="Person"></picture>
								</div>
							</div>
						</div>
					</div>
					<div class="page__flex-right page__flex-right--fdc" style="position: absolute; top: 3.6rem;">
						<div class="page__contacts">
							<div class="page__contacts-block" style="position: absolute; left: 0;">
								<a href="tel:+79054280000">+7 905 428 00 00</a> <br>
								<a href="tel:+79014280000">+7 901 428 00 00</a>
							</div>
							<div class="page__contacts-block" style="position: absolute; right: 0;">
								<a href="www.tesla-online.ru">www.tesla-online.ru</a> <br>
								<a href="www.atr.ru">www.atr.ru</a>
							</div>
						</div>
						<div class="page__contacts-table" style="position: absolute; top: 1.5rem; width: 100%;">
							<p class="page__contacts-table-title">ООО «Автотрейдер»</p>
							<table class="page__table table">
								<tr>
									<td class="table__bold">
										ИНН/КПП
									</td>
									<td>
										9703082356/ 770301001
									</td>
								</tr>
								<tr>
									<td class="table__bold">
										Юридический <br>
										адрес
									</td>
									<td>
										Российская Федерация, <br>
										г. Москва, ул. Антонова- <br> Овсеенко, д. 15, с.4, оф.103
									</td>
								</tr>
								<tr>
									<td class="table__bold">
										Р/с
									</td>
									<td>
										40702810601300031827 <br>
										В АО «Альфа-Банк»
									</td>
								</tr>
								<tr>
									<td class="table__bold">
										К/с
									</td>
									<td>
										30101810200000000593
									</td>
								</tr>
								<tr>
									<td class="table__bold">
										БИК
									</td>
									<td>
										044525593
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
		'.$footer.'
	</div>
</body>

</html>
', 'UTF-8');
// (Optional) Setup the paper size and orientation

// $customPaper = array(0,0,2480,3508);
// $dompdf->set_paper($customPaper);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('ATR_Presentation.pdf', array("Attachment" => false));