<?php

class m150219_124909_initial extends EDbMigration
{
	public function up()
	{ 
	    $this->createTable('blog', array(
	        'id' => 'pk',
	        'guid' => 'varchar(45) DEFAULT NULL',
	        'title' => 'varchar(255) DEFAULT NULL',
	        'message' => 'text DEFAULT NULL',
	        'published' => 'datetime default NULL',
	        'created_at' => 'datetime NOT NULL',
	        'created_by' => 'int(11) NOT NULL',
	        'updated_at' => 'datetime NOT NULL',
	        'updated_by' => 'int(11) NOT NULL',
	    ), '');
	    
	    $this->createIndex('unique_guid', 'blog', 'guid', true);
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