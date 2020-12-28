<?php

use common\components\helpers\HYii as Y;

Y::module('common')->publishJs('/js/tools/number_format.js');

CmsHtml::fancybox();

$cartAttributes = [
    ['count', '.input-num__input']
];
$offers = $product->getOffersData();
if (!empty($offers)) {
    $cartAttributes[] = [
        'offer',
        'js:(function(){var vals={};$(".js-offer-form select").each(function(){vals[$(this).data("prop")]=$(this).val();});return window.JSON.stringify(vals);})',
    ];

    $cartAttributes[] = [
        'color',
        'js:(function(){return $("[name=\'product_color\']:checked").data("title"); })'
    ];

    $cartAttributes[] = [
        'complectation',
        'js:(function(){
            var vals={};
            $("[name=\'product_complectation\']:checked").each(function(){
                vals[$(this).data("title")]=$(this).val();});
            return window.JSON.stringify(Object.keys(vals));
        })'
    ];

}

$category = $product->category;
$attributes = $category->getProductAttributes();

$attributeLabels = [];

foreach ($attributes as $attribute) {
    $propKey = $attribute['hash'];
    $attributeLabels[$propKey] = $attribute['title'];
}

$offers = $product->offersBehavior->get(true);

$offersResolve = [];

foreach ($offers as $offer) {
    $filtered = array_filter($offer, function ($v) {
        return !!trim($v);
    });
    if (empty($filtered)) continue;
    foreach ($offer as $offerAttributeKey => $offerAttribute) {
        if (in_array($offerAttributeKey, ['active'])) {
            continue;
        }

        $offersResolve[$offerAttributeKey][] = $offerAttribute;
    }
}

$cartAttrbites = [];

if ($offers) {
    $product->price = $offers[0]['price'];
    $cartAttrbites[] = ['offer', '#product-offer'];
}

?>

<? 
$jscode='window.productCanBuy=function(){';
$jscodeReturn='';

if($colors) {
    $jscode.='var $color=$(".product-page [name=\'product_color\']");';
    $jscode.='var colorChecked=($color.is(":checked") > 0);';
    $jscode.='var $colorName=$color.parents(".product-params-filter__color").find(".product-params-filter-name");';
    $jscode.='if(!colorChecked) $colorName.addClass("error"); else $colorName.removeClass("error");';
    $jscodeReturn.=($jscodeReturn?' && ':'').'colorChecked';
}

if($complectations) {
    $jscode.='var $complectation=$(".product-page [name=\'product_complectation\']");';
    $jscode.='var complectationChecked=($complectation.is(":checked") > 0);';
    $jscode.='var $complectationName=$complectation.parents(".product-params-filter__complectation").find(".product-params-filter-name");';
    $jscode.='if(!complectationChecked) $complectationName.addClass("error"); else $complectationName.removeClass("error");';
    $jscodeReturn.='complectationChecked';
}

$jscode.='return '.($jscodeReturn?:'true').';};';
Y::js(false, $jscode, \CClientScript::POS_READY);
?>

<h1><?= $product->getMetaH1() ?></h1>

<div class="product-page">
    <div class="product-page__row">
        <div class="product-images product-page__images">
            <?php if (!Yii::app()->user->isGuest) echo CHtml::link('редактировать', array('cp/shop/productUpdate', 'id' => $product->id), array('class' => 'btn-product-edit', 'target' => 'blank')); ?>
            <div class="js__main-photo product-main-img<?= HtmlHelper::getMarkCssClass($product, ['sale', 'new', 'hit']) ?>">
                <?php if ($product->mainImageBehavior->isEnabled()) : ?>
                    <?= CHtml::link(CHtml::image(ResizeHelper::resize($product->getSrc(), 820, 800)), $product->mainImageBehavior->getSrc(), ['class' => 'image-full', 'data-fancybox' => 'group']); ?>
                    <?else:?>
                    <img src="<?= ResizeHelper::resize($product->getSrc(), 820, 800); ?>" alt="">
                    <?endif?>
            </div>

            <div class="more-images">
                <?foreach($product->moreImages as $id=>$img):?>
                <div class="more-images-item">
                    <a class="image-full" data-fancybox="group" href="<?= $img->url ?>" title="<?= $img->description ?>"><?= CHtml::image(ResizeHelper::resize($img->tmbUrl, 270, 270), $img->description); ?></a>
                </div>
                <?endforeach?>
            </div>
        </div>
        <div class="product-content product-page__content">
            <div class="product-filter-block">
                <form action="" class="js-offer-form">
                    <?php if ($offers) : ?>
                        <?php foreach ($attributeLabels as $key => $attribute) :
                            $offersResolve[$key] = array_filter($offersResolve[$key], function ($v) {
                                return !!trim($v);
                            });
                            if (count(array_unique($offersResolve[$key])) < 1) continue; ?>

                            <?php if ($attribute == 'Цвет') :
                                $colorsArr = [];
                                foreach (array_unique($offersResolve[$key]) as $value) {
                                    $colorsArr[] = $value;
                                }
                                $colors = explode(' ', $colorsArr[0]);
                            ?>
                                <div class="product-params-filter product-params-filter__color">
                                    <div class="product-params-filter-name"><?= $attribute ?>
                                    </div>
                                    <div class="product-params-filter-attr">
                                        <? foreach($colors as $color): ?>
                                        <div class="product-params-filter-item">
                                            <input type="radio" id="pf-2-<?= $color ?>" name="product_color" data-title="<?= $color ?>" />
                                            <label for="pf-2-<?= $color ?>" <? if($color) echo ' style="background: ' .$color.'"'?> title="Цвет: <?= $color ?>">&nbsp;</label>
                                        </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>


                            <?php elseif ($attribute == 'Доп. комплектация') :
                                $complectationsArr = [];
                                foreach (array_unique($offersResolve[$key]) as $value) {
                                    $complectationsArr[] = $value;
                                }
                                $complectations = explode('|', $complectationsArr[0]);
                                $complectation = [];
                                $names = [];
                                $costs = [];

                                for ($i=0; $i < count($complectations); $i++) { 
                                    $complectation[] = explode('-', $complectations[$i]);
                                    $names[] = $complectation[$i][0];
                                    $costs[] = $complectation[$i][1];
                                }
                            ?>
                                <div class="product-params-filter product-params-filter__complectation">
                                    <div class="product-params-filter-name"><?= $attribute ?></div>
                                    <div class="product-params-filter-attr">
                                        <div class="product-params-filter-item">
                                            <?php $i = 0;
                                            foreach ($complectations as $complectation) : ?>
                                                <div class="complectations-list">
                                                    <input type="checkbox" id="pc-2-<?= $i ?>" name="product_complectation" data-price="<?= $costs[$i] ?>" data-title="<?= $names[$i] ?>" />
                                                    <label class="target" for="pc-2-<?= $i ?>"><?= $names[$i] ?></label>
                                                </div>
                                            <?php $i++;
                                            endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="product-params-filter">
                                    <div class="product-params-filter__left"><?= $attribute ?></div>
                                    <div class="product-params-filter__right">
                                        <div class="product-params-filter__select-block">
                                            <select class="product-params-filter__select" name="<?= $key ?>" data-attribute="<?= $key ?>" data-prop="<?= $attribute ?>">
                                                <?php foreach (array_unique($offersResolve[$key]) as $value) : ?>
                                                    <option value="<?= $value ?>"><?= $value ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif ?>
                </form>
            </div>

            <div class="product-content__header">
                <span>Стоимость:</span>
                <p class="order-price order-price_sz_lg product-content__order-price">
                    <? if(D::cms('shop_enable_old_price')): ?>
                    <?php if ($product->old_price > 0) : ?>
                        <span class="old_price"><?=HtmlHelper::priceFormat($product['old_price'])?>
                        </span>
                    <?php endif; ?>
                    <? endif; ?>
                    <span class="new_price"><span class="js-price"><?=HtmlHelper::priceFormat($product['price'])?></span> руб.</span>
                </p>
            </div>

            <?if($product->notexist):?>
            нет в наличии
            <?else:?>
            <form class="order-form product-content__order">
                <div class="input-num input-num_js order-form__input">
                    <button type="button" class="input-num__btn-minus">-</button>
                    <input type="number" class="input-num__input" value="1">
                    <button type="button" class="input-num__btn-plus">+</button>
                </div>
                <?php $this->widget('\DCart\widgets\AddToCartButtonWidget', array(
                        'id' => $product->id,
                        'model' => $product,
                        'title' => '<span>Заказать</span>',
                        'cssClass' => 'input-num__submit btn btn_sz_sm shop-button button_1 js__photo-in-cart open-cart js-btn-add-to-cart',
                        'attributes' => $cartAttributes
                    ));
                ?>
            </form>
            <?endif?>

            <div class="product-content__description">
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

                <?if(D::yd()->isActive('shop') && (int)D::cms('shop_enable_attributes') && count($product->productAttributes)):?>
                <div class="product-attributes">
                    <ul>
                        <?php foreach ($product->productAttributes as $productAttribute) : ?>
                            <li><span><?= $productAttribute->eavAttribute->name; ?></span><span><?= $productAttribute->value; ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?if(!empty($product->description)):?>
            <div class="description">
                <?= $product->description ?>
            </div>
            <?endif?>
            </div>
        </div>
    </div>


    <script>
        $(function() {
            var prices = [],
                allAdded = false;

            $('[name="product_complectation"]').each(function() {
                prices.push($(this).data('price'));
            })

            $('.product-params-filter__complectation').on('click', '.target', function() {
                $(this).closest('.complectations-list').toggleClass('add-complectation');
                var addSum = $(this).siblings('input').data('price'),
                    allCheckList = $('.complectations-list').length,
                    checkedItems = $('.add-complectation').length
                currentAdded = !($(this).closest('.complectations-list ').hasClass('add-complectation'));


                if (checkedItems < allCheckList) allAdded = false;

                for (var i = 0; i < prices.length; i++) {
                    if (allAdded == false && currentAdded == false) {
                        $('.js-price').text(parseInt($('.js-price').text().replace(/\s/g, '')) + addSum);
                        break;
                    } else if (allAdded == false && currentAdded == true) {
                        $('.js-price').text(parseInt($('.js-price').text().replace(/\s/g, '')) - addSum);
                        break;
                    }

                }
                if (checkedItems == allCheckList) allAdded = true;
            })










            $('#installation').on('change', function() {
                var $self = $(this),
                    price = $self.data('price');

                refreshPrice();
            });

            var offers = <?= json_encode($offers) ?>;

            $('.product-params-filter__select').on('change', function() {
                var $self = $(this),
                    attribute = $self.data('attribute');

                var index = $self.index('.product-params-filter__select');

                var result = {};

                $('.product-params-filter__select').slice(0, index + 1).each(function() {
                    var $select = $(this);

                    result[$select.data('attribute')] = $select.val();
                });

                var $selectList = $('.product-params-filter__select').slice(index + 1);

                $selectList.each(function() {
                    $(this).html('');
                });

                for (var key in offers) {
                    var add = true;

                    for (var i in result) {
                        if (result[i] != offers[key][i]) {
                            add = false;

                            break;
                        }
                    }

                    if (add) {
                        for (var offerKey in offers[key]) {
                            var $select = $('select[data-attribute="' + offerKey + '"]');

                            if (result[offerKey] == undefined && $select.length) {
                                var value = offers[key][offerKey];

                                var isExist = !!$select.find('option').filter(function() {
                                    return $(this).attr('value').toLowerCase() === value.toLowerCase();
                                }).length;

                                if (!isExist) {
                                    if (offers[key][offerKey]) {
                                        $select.append('<option value="' + offers[key][offerKey] + '">' + offers[key][offerKey] + '</option>');
                                    }
                                }

                            }
                        }
                    }
                }

                $('.product-params-filter__select').each(function() {
                    var $select = $(this);
                    var $wrapper = $select.closest('.product-params-filter');

                    if (!$select.find('option').length || ($select.find('option').length == 1 && $select.find('option').eq(0).attr('value') == '')) {
                        $wrapper.hide();
                    } else {
                        $wrapper.show();
                    }
                });

                refreshPrice();

                $('#product-offer').val($('.js-offer-form').serialize());
            });

            $('.product-params-filter__select').eq(0).trigger('change');

            function refreshPrice() {
                var result = {};

                $('.complectations-list').removeClass('add-complectation');
                $('.complectations-list').find('input[type="checkbox"]').prop('checked', false);

                $('.product-params-filter__select').each(function() {
                    var $select = $(this);

                    result[$select.data('attribute')] = $select.val() ? $select.val() : '';
                });

                for (var key in offers) {
                    var add = true;

                    for (var i in result) {
                        if (result[i] != offers[key][i]) {
                            add = false;

                            break;
                        }
                    }

                    if (add) {
                        $('.js-price').text((+offers[key]['price'] + ($('#installation:checked').length ? +$('#installation').data('price') : 0)).format(0));
                    }
                }

                if ($.isEmptyObject(offers)) {
                    $('.js-price').text((<?= $product->price ?> + ($('#installation:checked').length ? +$('#installation').data('price') : 0)).format(0));
                }
            }
        });
    </script>