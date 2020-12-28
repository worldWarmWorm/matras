<?php

use common\components\helpers\HYii as Y;

CmsHtml::fancybox();
?>
<div class="cart-page">
    <div class="left-side">
        <div class="catalog">
            <h2>Каталог <div class="arrow-down">
            </h2>
            <?php $this->widget('widget.ShopCategories.ShopCategories') ?>
        </div>
    </div>

    <div class="right-side">
        <h1 class="product-h1"><?= $product->getMetaH1() ?></h1>

        <div class="product-page">
            <div class="product-page__in">

                <div class="product__left">
                    <div class="images">
                        <?php if (!Yii::app()->user->isGuest) echo CHtml::link('редактировать', array('cp/shop/productUpdate', 'id' => $product->id), array('class' => 'btn-product-edit', 'target' => 'blank')); ?>
                        <div class="js__main-photo product-main-img<?= HtmlHelper::getMarkCssClass($product, ['sale', 'new', 'hit']) ?>">
                            <?php if ($product->mainImageBehavior->isEnabled()) : ?>
                                <?= CHtml::link(CHtml::image(ResizeHelper::resize($product->getSrc(), 628, 722)), $product->mainImageBehavior->getSrc(), ['class' => 'image-full', 'data-fancybox' => 'group']); ?>
                                <?else:?>
                                <img src="<?= ResizeHelper::resize($product->getSrc(), 628, 722); ?>" alt="">
                                <?endif?>
                        </div>

                        <?php if ($product->moreImages) : ?>
                            <div class="more-images">
                                <?foreach($product->moreImages as $id=>$img):?>
                                <div class="more-images-item">
                                    <a class="image-full" data-fancybox="group" href="<?= $img->url ?>" title="<?= $img->description ?>">
                                        <?= CHtml::image(ResizeHelper::resize($img->url, 300, 230), $img->description); ?>
                                    </a>
                                </div>
                                <?endforeach?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="product__right">

                    <?if(!empty($product->description)):?>
                    <div class="description">
                        <div class="description__h">Описание:</div>
                        <?= $product->description ?>
                    </div>
                    <?endif?>

                    <div class="options">
                        <div class="buy">
                            <p class="order__price">
                                <? if(D::cms('shop_enable_old_price')): ?>
                                <?php if ($product->old_price > 0) : ?>
                                    <span class="old_price"><?= HtmlHelper::priceFormat($product->old_price); ?>
                                        <span class="rub">руб</span>
                                    </span>
                                <?php endif; ?>
                                <? endif; ?>
                                <span class="new_price new_price_in"><?= HtmlHelper::priceFormat($product->price); ?>
                                    <span class="rub">руб</span>
                                </span>
                            </p>




                        </div>

                        <?if(!empty($product->brand_id)):?>
                        <div class="product-brand">
                            <strong>Бренд:</strong> <?= $product->brand->title ?>
                        </div>
                        <?endif?>
                        <?if(!empty($product->code)):?>
                        <div class="product-code">
                            <strong>Артикул:</strong> <?= $product->code ?>
                        </div>
                        <?endif?>

                        <div class="product-filter-block">
                            <? if($colors=$product->colorsBehavior->getRelated()): ?>
                            <div class="product-params-filter product-params-filter__size">
                                <div class="product-params-filter-attr">
                                    <? foreach($colors as $color): ?>
                                    <div class="product-params-filter-item">
                                        <input type="radio" id="pcf-2-<?= $color->id ?>" name="product_color" data-title="<?= $color->title ?>" />
                                        <label for="pcf-2-<?= $color->id ?>" <? if($color->hexcode) echo ' style="background: '.$color->hexcode.'"'?> title="<?= $color->title ?>">&nbsp;</label>
                                    </div>
                                    <? endforeach; ?>
                                </div>
                                <div class="product-params-filter-name product-params-filter-name__color"></div>
                            </div>
                            <? endif; ?>

                            <? if($sizes=$product->sizesBehavior->getRelated()): ?>
                            <div class="product-params-filter product-params-filter__size">
                                <div class="product-params-filter-attr">
                                    <? foreach($sizes as $size): ?>
                                    <div class="product-params-filter-item">
                                        <input type="radio" id="pf-2-<?= $size->id ?>" name="product_size" data-title="<?= $size->title ?>" />
                                        <label for="pf-2-<?= $size->id ?>"><?= $size->title ?></label>
                                    </div>
                                    <? endforeach; ?>
                                </div>
                                <div class="product-params-filter-name product-params-filter-name__size"></div>
                            </div>
                            <? endif; ?>
                        </div>

                        <? 
						$jscode='window.productCanBuy=function(){';
						$jscodeReturn='';
						if($sizes) {
						    $jscode.='var $size=$(".product-page [name=\'product_size\']");';
						    $jscode.='var sizeChecked=($size.is(":checked") > 0);';
						    $jscode.='var $sizeName=$size.parents(".product-params-filter:first").find(".product-params-filter-name");';
						    $jscode.='if(!sizeChecked) $sizeName.addClass("error"); else $sizeName.removeClass("error");';
						    $jscodeReturn.='sizeChecked';
						}
						if($colors) {
						    $jscode.='var $color=$(".product-page [name=\'product_color\']");';
						    $jscode.='var colorChecked=($color.is(":checked") > 0);';
						    $jscode.='var $colorName=$color.parents(".product-params-filter:first").find(".product-params-filter-name");';
						    $jscode.='if(!colorChecked) $colorName.addClass("error"); else $colorName.removeClass("error");';
						    $jscodeReturn.=($jscodeReturn?' && ':'').'colorChecked';
						}
						
						$jscode.='return '.($jscodeReturn?:'true').';};';
						Y::js(false, $jscode, \CClientScript::POS_READY);
						?>

                        <?if(D::yd()->isActive('shop') && (int)D::cms('shop_enable_attributes') && count($product->productAttributes)):?>
                        <div class="product-attributes">
                            <ul>
                                <?php foreach ($product->productAttributes as $productAttribute) : ?>
                                    <li><span><?= $productAttribute->eavAttribute->name; ?></span><span><?= $productAttribute->value; ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?if($product->notexist):?>
                    нет в наличии
                    <?else:?>
                    <?php $this->widget('\DCart\widgets\AddToCartButtonWidget', array(
                        'id' => $product->id,
                        'model' => $product,
                        'title' => '<span>В корзину</span>',
                        'cssClass' => 'btn shop-button to-cart button_1 js__photo-in-cart open-cart',
                        'attributes' => [
                            // ['count', '.counter_input'],
                            ['color', 'js:(function(){return $("[name=\'product_color\']:checked").data("title"); })'],
                            ['size', 'js:(function(){return $("[name=\'product_size\']:checked").data("title"); })']
                        ]
                    ));
                    ?>
                    <?endif?>
                    </div>
                    <!-- <div class="clr"></div> -->

                </div>

            </div>


        </div>

        <?if(D::cms('shop_enable_reviews')) $this->widget('widget.productReviews.ProductReviews', array('product_id' => $product->id))?>
    </div>
</div>