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

    public function run()
    {
        if ($this->object->editRoute != "" && $this->object->canWrite()) {
            $this->render('editLink', array(
                'object' => $this->object,
            ));
        }
        
        if ($this->object->canDelete()) {
            $this->render('deleteLink', array(
                'model' => $this->object,
                'title' => Yii::t('BlogModule.widgets_BlogEntryControls', 'Confirm blog post deletion'),
                'message' => Yii::t('BlogModule.widgets_BlogEntryControls', 'Are you sure you want to delete this blog post?')
            ));
        }
    }
    
}

?>