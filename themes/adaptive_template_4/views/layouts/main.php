<?php use common\components\helpers\HYii as Y; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    CmsHtml::head();
    CmsHtml::js($this->template . '/js/bootstrap.min.js');
    CmsHtml::js($this->template . '/js/jquery.mmenu.all.js');
    CmsHtml::js('/js/slick.min.js');
    CmsHtml::js($this->template . '/js/script.js');
    CmsHtml::js('/js/main.js');
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="canonical" href="<?=$this->createAbsoluteUrl('/').preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI'])?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        .product__image.sale:before,
        .product-main-img.sale:before {
            content: "Акция";
        }
        .product__image.new:before,
        .product-main-img.new:before {
            content: "Новинка";
        }
        .product__image.hit:before,
        .product-main-img.new.hit:before {
            content: "Хит";
        }
        ul.yiiPager .previous a:before {
            content: "Предыдущая";
        }
        ul.yiiPager .next a:before {
            content: "Следующая";
        }
    </style>
    <link rel="stylesheet" type="text/css" href="/themes/adaptive_template_4/css/add.css" />  
</head>

<body class="pages <?= D::c($this->isIndex(), 'index-page', 'inner-page') ?>">

    <header class="header pages__header">
        <div class="header__container container">
            <div class="header__row">
                <div class="header__top-left">
                    <div class="logo-wrapper">
                    	<a href="/" class="logo header__logo">Центр Матрасов и Кроватей</a>
                    </div> 
                    <div class="address-block">
                      <address><?= D::cms('address') ?></address>
                    </div> 

                </div>

                <div class="header__top-right-wrapper">
                    <div class="header__top-right-cont">
		                <div class="header__top-center">
		                    <a class="header__phone" href="tel:<?= preg_replace('/[^0-9+]/', '', D::cms('phone')) ?>"><?= D::cms('phone') ?></a>
		                </div>
		                <div class="header__top-right">
		                    <form class="search header__search" action="/search" method="get">
		                        <input class="search__input" type="text" name="q" autocomplete="off" >
		                    </form>
		                </div>
                     </div>
                    <div class="header__top-right-info">
                    	<a href="mailto:<?= D::cms('emailPublic'); ?>"><?= D::cms('emailPublic'); ?></a>
                        <p><?= D::cms('workinghours') ?> </p>
                    </div>

                </div>   

                <div class="header__bottom-left">
                    <nav class="header__nav">
                        <? $this->widget('\menu\widgets\menu\MenuWidget', array(
                            'rootLimit'=>D::cms('menu_limit'),
                            'cssClass'=>'main-menu header__main-menu'
                            ));
                            ?>
                        </nav>
                    </div>
                    <div class="header__bottom-right">
                        <a href="<?=D::cms('vk_link')?>" target="_blank" class="header__social social social_icon_vk"></a>
                        <a class="cart header__cart" href="/cart">
                            <span class="cart__counter">
                                (<span class="dcart-total-count"><?=\Yii::app()->cart->getTotalCount()?></span>)
                            </span>
                        </a>
                        <a href="#mmenu" class="header__mmenu-btn mmenu-btn" aria-label="Открыть меню"></a>
                    </div>
                </div>
            </div>
        </header>

        <?=$content?>

        <footer class="footer pages__footer">
            <div class="footer__container container">
                <div class="footer__left">
                    <div class="footer__text">
                        <?= D::cms('privacy_policy_text') ?>
                    </div>
                </div>
                <div class="footer__right">
                    <div class="kontur footer__kontur">
                        <div class="kontur__text">
                            <a class="kontur__link footer__text" href="http://kontur-lite.ru/" title="KONTUR - Продвижение сайтов" target="_blank">KONTUR - Продвижение сайтов</a><br><br>
                       <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,twitter,reddit,pocket,viber,whatsapp,skype,telegram"></div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </footer>

        <div id="totop"><p>&#xe851;</p> ^ Наверх</div>

        <nav id="mmenu">
            <? $this->widget('\menu\widgets\menu\MenuWidget', array(
                'rootLimit'=>D::cms('menu_limit'),
                'cssClass'=>''
                ));
                ?>
            </nav>

            <?php if (D::yd()->isActive('feedback')): // обратный звонок ?>
                <div style="display: none;">
                    <div id="form-callback">
                        <div class="popup-info">
                            <?php $this->widget('\feedback\widgets\FeedbackWidget', array('id' => 'callback')) ?>
                        </div>
                    </div>
                </div>
            <?php endif; // обратный звонок ?>
<script type='application/ld+json'> 
{
  "@context": "http://www.schema.org",
  "@type": "FurnitureStore",
  "name": "Центр Матрасов и Кроватей",
  "description": "Мебель на заказкорпусная мебельматрасы",
  "url": "https://matras-centr.com/",
  "image": "https://matras-centr.com/logo-for-schema.jpeg",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ул. Калинина, д 82, стр 15, офис 200",
    "addressLocality": "Красноярск",
    "addressRegion": "Красноярский край",
    "postalCode": "660001",
    "addressCountry": "Россия"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "56.040550",
    "longitude": "92.786700"
  },
  "openingHours": "Mo, Tu, We, Th, Fr 10:00-19:30 Sa, Su 10:00-18:00",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+7 (913) 513-44-55"
  },
  "telephone": "+7 (913) 513-44-55",
  "priceRange": "$$$"
}
</script>
        </body>
        </html>
