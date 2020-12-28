<?php
/**
 * Файл настроек модели
 */
use common\components\helpers\HYii as Y;

return [
	'class'=>'\ProductComplectations',
	'menu'=>[
		'backend'=>['label'=>'Комплектации']
	],
	'buttons'=>[
		'create'=>['label'=>'Добавить комплектацию'],
	],
	'crud'=>[
		'index'=>[
            'url'=>'/cp/crud/index',
			'title'=>'Комплектации',
			'gridView'=>[
				'sortable'=>[
                    'url'=>'/cp/crud/sortableSave',
                    'category'=>'product_complectations',
                ],
				'columns'=>[
					[
						'name'=>'title',
						'header'=>'Наименование',
						'type'=>'raw',
						'value'=>'"<strong>".CHtml::link($data->title,["/cp/crud/update", "cid"=>"product_complectations", "id"=>$data->id])."</strong>"'
					],
					[
						'name'=>'price',
						'header'=>'Сумма удорожания',
						'type'=>'raw',
						'value'=>'($data->price ? "<br/>Сумма удорожания: <small>{$data->price}</small>" : "")'
					],
					[
						'name'=>'active',
						'type'=>'common.ext.active'
					],
					'crud.buttons'
				]
			]
		],
		'create'=>[
			'url'=>'/cp/crud/create',
			'title'=>'Новая комплектация',
		],
		'update'=>[
			'url'=>['/cp/crud/update'],
			'title'=>'Редактирование комплектации',
		],
		'delete'=>[
            'url'=>['/cp/crud/delete'],
		],
		'form'=>[
			'attributes'=>[
                'active'=>'checkbox',
				'title',
				'price',
			]
		]
	],
];
