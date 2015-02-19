<li>
    <?php
    echo HHtml::link('<i class="fa fa-pencil"></i> ' . Yii::t('BlogModule.widgets_views_editLink', 'Edit'), 
        Yii::app()->createUrl($editRoute, array('guid' => $id)),
        array(
        //'success' => "js:function(html){ $('.preferences .dropdown').removeClass('open'); $('#" . $object->getUniqueId() . "').replaceWith(html); }"
    ));
    ?>
</li>