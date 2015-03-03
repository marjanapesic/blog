<?php

class m150219_124909_initial extends EDbMigration
{
	public function up()
	{ 
	    $this->createTable('blog', array(
	        'id' => 'pk',
	        'title' => 'varchar(255) DEFAULT NULL',
	        'message' => 'text DEFAULT NULL',
	        'published' => 'tinyint(1) default 0',
	        'created_at' => 'datetime NOT NULL',
	        'created_by' => 'int(11) NOT NULL',
	        'updated_at' => 'datetime NOT NULL',
	        'updated_by' => 'int(11) NOT NULL',
	    ), '');
	   
	}

	public function down()
	{
		echo "m150219_124909_initial does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}