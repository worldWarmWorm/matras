<?php

class m171205_035051_create_product_complectations_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('product_complectations', [
            'id'=>'pk',
            'title'=>'string',
			'active'=>'boolean',
			'price'=>'string'
        ]);
	}

	public function down()
	{
		echo "m171205_035051_create_product_complectations_table does not support migration down.\n";
//		return false;
	}
}
