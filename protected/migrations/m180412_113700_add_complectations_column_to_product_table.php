<?php

class m180412_113700_add_complectations_column_to_product_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('product', 'complectations', 'string');
	}

	public function down()
	{
		echo "m180412_113700_add_complectations_column_to_product_table does not support migration down.\n";
//		return false;
	}
}
