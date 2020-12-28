<?php
/**
 * Конфигурационный файл для компонента \DCart\components\DCart
 */
return array(
	'class' => '\DCart\components\DCart',
	'attributeImage' => 'cartImg',
	'extendKeys'=>['offer', 'color', 'complectation'],
	'cartAttributes' => [ // аттрибуты которые будут отображены дополнительно в виджете корзины
	   'offer',
	   'color',
	   'complectation'
	],
	'attributes' => [ // аттрибуты, которые будут сохранены для заказа
	    'code',// => ['onAfterAdd'=>'afterAddCart', 'onAfterUpdate'=>'afterAddCart']
		'offer'=>['onAfterAdd'=>'afterAddCart'],
		'color'=>['onAfterAdd'=>'afterAddCart'],
		'complectation'=>['onAfterAdd'=>'afterAddCart']
	]
);
