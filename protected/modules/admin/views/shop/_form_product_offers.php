<?php
/** @var [] $productOfferAttributes */
use common\components\helpers\HArray as A;
?>
<div class="row">
	<?= $form->labelEx($model, 'offers'); ?>
	<? $this->widget('\common\ext\dataAttribute\widgets\DataAttribute', [
	    'behavior' => $model->offersBehavior,
	    'header'=>A::m($productOfferAttributes, ['price'=>'Цена (руб)']),
	    'types'=>[
	        'price'=>['type'=>'number', 'params'=>['htmlOptions'=>['class'=>'form-control w100', 'style'=>'height:40px']]]
	    ],
	    'showCopyButton'=>true
	]); ?>
</div>
