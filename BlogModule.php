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

    public function init()
    {
        $this->setImport(array('blog.components.*'));
        
        Yii::setPathOfAlias('cebe',Yii::getPathOfAlias('blog.vendors.cebe'));
        
        return parent::init();
    }

    /**
     * On build of the top menu widget, add the forum and blog if module is enabled.
     *
     * @param type $event            
     */
    public static function onTopMenuInit($event)
    {
        if (Yii::app()->moduleManager->isEnabled('blog')) {

            $event->sender->addItem(array(
                'label' => Yii::t('BlogModule.base', 'Blog'),
                'id' => 'forum',
                'icon' => '<i class="fa fa-files-o"></i>',
                'url' => Yii::app()->createUrl('//blog/index'),
                'sortOrder' => 501,
            ));
            
        }
    }
}
?>