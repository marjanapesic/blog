<?php

class uninstall extends ZDbMigration
{

    public function up()
    {
        $this->delete('notification', 'source_object_model=:blog', array(':blog' => 'Blog'));
        
        foreach (Content::model()->findAll(array(
            'object_model' => 'Blog')) as $content) 
            $content->delete();
   
        $this->dropTable('blog');
    }

    public function down()
    {
        echo "m150219_124909_initial does not support migration down.\n";
        return false;
    }
}
?>