<?php

class BlogMenuWidget extends MenuWidget {

    public $template = "application.widgets.views.leftNavigation";

    public function init() {

        $this->addItemGroup(array(
            'id' => 'modules',
            'label' => Yii::t('BlogModule.widgets_BlogMenuWidget', '<strong>Blog</strong> menu'),
            'sortOrder' => 100,
        ));

        $this->addItem(array(
            'label' => Yii::t('BlogModule.widgets_BlogMenuWidget', 'Blogs'),
            'group' => 'modules',
            'url' => Yii::app()->createUrl('//blog/index', array()),
            'icon' => '<i class="fa fa-bars"></i>',
            'sortOrder' => 100,
            'isActive' => (Yii::app()->controller->id == "index" && Yii::app()->controller->action->id != "draft"),
        ));
        
        $criteria=new CDbCriteria();
        $criteria->addCondition("published IS NULL");
        
        $draftCount = Blog::model()->count($criteria);
        $countText = $draftCount ? " (".$draftCount.")" : "";
        
        $this->addItem(array(
            'label' => Yii::t('BlogModule.widgets_BlogMenuWidget', 'Drafts').$countText,
            'group' => 'modules',
            'url' => Yii::app()->createUrl('//blog/index/draft', array()),
            'icon' => '<i class="fa fa-bars"></i>',
            'sortOrder' => 200,
            'isActive' => (Yii::app()->controller->id == "index" && Yii::app()->controller->action->id == "draft"),
        ));

#        $this->addItem(array(
#            'label' => Yii::t('SpaceModule.widgets_SpaceMenuWidget', 'Members'),
#            'url' => Yii::app()->createUrl('//space/space/members', array('sguid'=>$spaceGuid)),
#            'sortOrder' => 200,
#            'isActive' => (Yii::app()->controller->id == "space" && Yii::app()->controller->action->id == "members"),
#        ));
#        $this->addItem(array(
#            'label' => Yii::t('SpaceModule.widgets_SpaceMenuWidget', 'Admin'),
#            'url' => Yii::app()->createUrl('//space/admin', array('sguid'=>$spaceGuid)),
#            'sortOrder' => 9999,
#            'isActive' => (Yii::app()->controller->id == "admin" && Yii::app()->controller->action->id == "index"),
#        ));


        parent::init();
    }

}

?>
