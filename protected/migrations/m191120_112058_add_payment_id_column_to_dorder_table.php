<?php

class m191120_112058_add_payment_id_column_to_dorder_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('dorder', 'payment_id', 'string');
	}

	public function down()
	{
		echo "m191120_112058_add_payment_id_column_to_dorder_table does not support migration down.\n";
//		return false;
	}
}
