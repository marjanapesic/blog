<?php
echo HHtml::link(Yii::t('BlogModule.widgets_views_editLink', 'Edit'), Yii::app()->createUrl($object->editRoute, array(
    'id' => $object->id,
    'sguid' => $object->content->container->guid
)), array(
    'class' => 'btn btn-xs btn-primary pull-right'
));
?>