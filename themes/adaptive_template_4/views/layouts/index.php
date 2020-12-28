<?php $this->beginContent('//layouts/main'); ?>

<section class="main-slider pages__main-slider">
            <div class="main-slider__arrows slider-arrows container"></div>
            <div class="main-slider__dots slider-dots container"></div>
            <div class="main-slider__init">
                <?php foreach (IBHelper::getElements(1) as $element): ?>
                    <div class="main-slider__slide">
                        <div class="main-slider__container container">
                            <div class="main-slider__row">
                                <div class="main-slider__left">
                                    <h3 class="main-slider__title"><?= $element['props']['TITLE'] ?></h3>
                                    <b class="main-slider__subtitle"><?= $element['props']['SUBTITLE'] ?></b>
                                    <p class="main-slider__text"><?= $element['props']['TEXT'] ?></p>
                                    <a href="javascript:;" class="main-slider__callback btn" data-fancybox="" data-src="#form-callback">Заказать звонок</a>
                                </div>
                                <div class="main-slider__right">
                                    <div class="main-slider__image-wrap">
                                        <?php if ($element['props']['LINK']): ?>
                                            <a href="<?= $element['props']['LINK'] ?>"><img src="<?=ResizeHelper::resize($element['preview'], 600, 420); ?>" alt="" class="main-slider__image"></a>
                                        <?php else: ?>
                                            <img src="<?=ResizeHelper::resize($element['preview'], 600, 420); ?>" alt="" class="main-slider__image">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="catalog-tile pages__catalog-tile">
            <div class="catalog-tile__container container">
                <? $this->widget('widget.catalog.CategoryListWidget'); ?>
            </div>
        </section>

        <section class="actions pages__actions">
            <div class="actions__container container">
                <h2 class="actions__title">Акции</h2>
                <?$this->widget('widget.catalog.ProductCarouselWidget')?>
            </div>
        </section>

<?php $this->endContent(); ?>
