<?php
/** @var \DCart\widgets\CartWidget $this */
/** @var \DCart\components\DCart $cart */
?>
<?if($cart->isEmpty()):?>
<div class="dcart-mcart-empty">
	Ваша корзина пуста
</div>
<?else:?>
<div class="adaptive-cart-page clearfix js-dcart-mcart">
	
	<div class="adaptive-cart__head d-none d-sm-block">
		<div class="row">
			<div class="adaptive-cart-page__cell-head adaptive-cart__col-first">Фото</div>
			<div class="col-8 col-sm-9">
				<div class="row">
					<div class="adaptive-cart-page__cell-head adaptive-cart__col-second">Товар</div>
					<div class="adaptive-cart-page__cell-head adaptive-cart__col-third">Количество</div>
					<div class="adaptive-cart-page__cell-head adaptive-cart__col-fourth">Цена</div>
					<div class="adaptive-cart-page__cell-head adaptive-cart__col-fifth">Сумма</div>
					<div class="adaptive-cart-page__cell-head adaptive-cart__col-sixth"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="js-dcart-items">
		<?foreach($cart->getData() as $hash=>$data) $this->render('_modal_cart_item', compact('cart', 'hash', 'data'));?>
	</div>
	
	<div class="adaptive-cart__total-value-box">
		<div class="row">
			<div class="col-12 col-md-5">
				Итоговая цена: <span class="adaptive-cart__total-value dcart-total-price"><?=HtmlHelper::priceFormat($cart->getTotalPrice())?></span>
				<span class="adaptive-cart__total-value-cur">₽</span>
			</div>
			<div class="col-12 col-md-7 text-left">
				<p>Что-то забыли? <a href="/catalog">Хотите вернуться и положить еще?</a></p>
			</div>
		</div>
	</div>
	<div class="adaptive-cart__link-order">
		<div class="row">
			<div class="col-12">
				<a href="/order" class="btn btn_sz_sm">Заказать</a>
			</div>
		</div>
	</div>
</div>
<?endif?>