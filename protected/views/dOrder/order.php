<?php
/** @var DOrderController $this */

$this->widget('\DOrder\widgets\actions\OrderWidget', array(
	'mailAttributes' => array('color', 'complectation'),
	'adminMailAttributes' => array('color', 'complectation')
));
?>