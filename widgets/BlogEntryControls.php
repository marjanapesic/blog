<?php

/**
 * BlogEntryControls is a instance of StackWidget 
 *
 * @package humhub.modules.blog.widgets
 * @since 0.10
 */
class BlogEntryControls extends StackWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public function init(){
        
        
        
          
     /*   $this->addWidget('application.modules.forum.widgets.EditLinkWidget', array(
            'object' => $this->object
            )
        );*/
    }
    
    public function run() {
        
        if ($this->object->content->canDelete()) {
            $this->render('deleteLink', array(
                'model' => $this->object,
                'id' => $this->object->content->object_id,
                'title' => Yii::t('BlogModule.wifgets_BlogEntryControls', 'Confirm blog post deletion'),
                'message' => Yii::t('BlogModule.wifgets_BlogEntryControls', 'Are you sure you want to delete this blog post?'),
            ));
        }
        
        if ($this->object->editRoute != "" && $this->object->content->canWrite()) {
            $this->render('editLink', array(
                'id' => $this->object->guid,
                'object' => $this->object,
                'editRoute' => $this->object->editRoute
            ));
        }
    }
    
}

?>