<?php

/**
 * This widget is used to display blog drafts
 *
 * @package humhub.modules.blog.widgets
 * @since 0.10
 */
class DraftsWidget extends HWidget
{

    public function run()
    {
        $space = Yii::app()->getController()->getSpace();

        $criteria = new CDbCriteria;
        $criteria->mergeWith(array(
            'join'=>'INNER JOIN content ON content.object_model="Blog" and content.object_id=t.id and content.space_id='.$space->id
        ));
        $criteria->condition = "t.published IS NULL and t.created_by=".Yii::app()->user->id;
        
        $drafts = Blog::model()->findAll($criteria);

        $this->render('drafts', array('drafts' => $drafts));
    }
}
?>