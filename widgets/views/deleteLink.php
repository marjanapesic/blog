<li>
    <!-- load modal confirm widget -->
    <?php 
        //$firstPostNotice = (isset($model->isFirstPost) && $model->isFirstPost) ? " ".Yii::t('ForumBlog.widgets_views_deleteLink', 'By deleting this post the whole topic will be deleted') : '';
        $this->widget('application.widgets.ModalConfirmWidget', array(
        'uniqueID' => 'modal_blogdelete_'. $id,
        'linkOutput' => 'a',
        'title' => $title,
        'message' => $message,
        'buttonTrue' => Yii::t('BlogModule.widgets_views_deleteLink', 'Delete'),
        'buttonFalse' => Yii::t('BlogModule.widgets_views_deleteLink', 'Cancel'),
        'linkContent' => '<i class="fa fa-trash-o"></i> ' . Yii::t('BlogModule.widgets_views_deleteLink', 'Delete'),
        'linkHref' => Yii::app()->createUrl("//blog/index/delete", array('model' => $model->content->object_model, 'id' => $id)),
        //'confirmJS' => 'function(jsonResp) {jsonResp = JSON.parse(jsonResp); if(jsonResp["success"] == true) {$("#'.$model->getUniqueId().'").hide();}}'
    ));

    ?>
</li>