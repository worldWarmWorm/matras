<?php

?>
<div class="row">
	<?= $form->labelEx($model, 'offer_attributes'); ?>
	<? $this->widget('\common\ext\dataAttribute\widgets\DataAttribute', [
	    'behavior' => $model->offerAttributesBehavior,
		'header'=>[
		    'title'=>'Наименование',
		    'hash'=>['title'=>'','htmlOptions'=>['style'=>'width:1% !important']]
		],
	    'types'=>['hash'=>'hidden'],
		'default' =>[
			['title'=>''],
		]
	]); ?>
</div>