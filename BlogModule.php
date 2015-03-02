<?php

class BlogModule extends HWebModule
{

    private $assetsUrl;

    public function getAssetsUrl()
    {
        if ($this->assetsUrl === null)
            $this->assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('blog.assets'));
        return $this->assetsUrl;
    }

    public function behaviors()
    {
        return array(
            'SpaceModuleBehavior' => array(
                'class' => 'application.modules_core.space.behaviors.SpaceModuleBehavior',
            ),
        );
    }
    
    public function init()
    {
        $this->setImport(array('blog.components.*'));
        
        Yii::setPathOfAlias('cebe',Yii::getPathOfAlias('blog.vendors.cebe'));
        $assetPrefix = Yii::app()->assetManager->publish(dirname(__FILE__) . '/resources', true, 0, defined('YII_DEBUG'));
        Yii::app()->clientScript->registerCssFile($assetPrefix . '/blog.css');

        return parent::init();
    }


    /**
     * On build of a Space Navigation, check if this module is enabled.
     * When enabled add a menu item
     *
     * @param type $event        	
     */
    public static function onSpaceMenuInit($event)
    {
        $space = Yii::app()->getController()->getSpace();
        if ($space->isModuleEnabled('blog')) {
            $event->sender->addItem(array(
                'label' => Yii::t('BlogModule.base', 'Blog'),
                'url' => Yii::app()->createUrl('/blog/blog/index', array('sguid' => $space->guid)),
                'icon' => '<i class="fa fa-files-o"></i>',
                'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'blog')
            ));
            
        }
    }
    
    
    public function disable()
    {
        if (parent::disable()) {
            foreach (Content::model()->findAll(array(
                'condition' => 'object_model=:blog',
                'params' => array(':blog' => 'Blog'))) as $content) {
                $content->delete();
            }
            return true;
        }
        throw new CHttpException(404);
        return false;
    }
    
}
?>