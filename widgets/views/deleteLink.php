<!-- load modal confirm widget -->
<?php
$this->widget('application.widgets.ModalConfirmWidget', array(
    'uniqueID' => 'modal_blogdelete_' . $model->id,
    'linkOutput' => 'a',
    'title' => $title,
    'message' => $message,
    'buttonTrue' => Yii::t('BlogModule.widgets_views_deleteLink', 'Delete'),
    'buttonFalse' => Yii::t('BlogModule.widgets_views_deleteLink', 'Cancel'),
    'linkContent' => Yii::t('BlogModule.widgets_views_deleteLink', 'Delete'),
    'linkHref' => Yii::app()->createUrl("//blog/blog/delete", array(
        'id' => $model->id,
        'sguid' => $model->content->container->guid
    )),
    'class' => 'btn btn-xs btn-danger pull-right'
));

?>