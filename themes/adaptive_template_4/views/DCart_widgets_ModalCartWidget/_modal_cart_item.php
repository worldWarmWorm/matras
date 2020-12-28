<?php
/** @var \DCart\widgets\CartWidget $this */
/** @var \DCart\components\DCart $cart */
/** @var string $hash cart item hash */
/** @var string $data cart item data */
?>
<div class="adaptive-cart__item js-mcart-item" data-hash="<?=$hash?>">
    <div class="row">
      <div class="adaptive-cart__col-first">
      	<div class="adaptive-cart__images">
          <img class="img-responsive" src="<?=ResizeHelper::resize($cart->getImage($hash), 320, 320); ?>" alt="">
      	</div>
      </div>
      <div class="col-xs-8 col-sm-9">
        <div class="row">
          <div class="adaptive-cart__col-second">
         		<div class="adaptive-cart__name">
         		<?=\CHtml::link(
					$data['attributes'][$cart->attributeTitle],
					array('shop/product', 'id'=>$data[$cart->attributeId]),
					array('title'=>$data['attributes'][$cart->attributeTitle])
				)?>
				<?php foreach($cart->getAttributes(true, false, true) as $attribute):
					list($label, $value) = $cart->getAttributeValue($hash, $attribute, true);
					if($value):?>
						<?php $params = str_replace([','], [' + '], str_replace(['"', '[', ']'], [], $value));
						if(!empty($params)):?>
						<p>
							<small>
								<?=D::c($label, $label.':')?>
								<i>
									<?= $params ?>
									<?php if($label == 'Цвет'):?>
										<span class="circle" style="background-color: <?= $params ?>"></span>
									<?php endif;?>
								</i>
							</small>
						</p>
						<?php endif; ?>
					<?endif; endforeach; ?>
         		</div>
          </div>
          <div class="adaptive-cart__col-third count">
          	<div class="adaptive-cart__count number input-num">
            	<span class="input-num__btn-minus down">-</span>
            	<?=\CHtml::textField('count', $data['count'], ['data-hash'=>$hash, 'size'=>7,'maxlength'=>20, 'class'=>'input-num__input']);?>
            	<span class="input-num__btn-plus up">+</span>
	          </div>
		  </div>
          <div class="adaptive-cart__col-fourth">
          	<div class="adaptive-cart__unit-price">
          		<span class="adaptive-cart__price unit-price"><?=HtmlHelper::priceFormat($data['price'])?></span>
          		<span class="adaptive-cart__price-cur">₽</span></div>
          </div>
          <div class="adaptive-cart__col-fifth">
          	<div class="adaptive-cart__total-price">
          		<span class="adaptive-cart__price total-price"><?=HtmlHelper::priceFormat($data['count']*$data['price'])?></span>
          		<span class="adaptive-cart__price-cur">₽</span></div>
          </div>
          <div class="adaptive-cart__col-sixth">
          	<div class="adaptive-cart__delite">
            	<?=\CHtml::link('', 'javascript:;', array(
					'class'=>'js-mcart-btn-remove',
					'title'=>'Удалить',
					'data-hash'=>$hash
				))?>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>