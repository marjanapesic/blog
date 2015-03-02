<?php

Yii::app()->moduleManager->register(array(
    'id' => 'blog',
    'class' => 'application.modules.blog.BlogModule',
    'import' => array(
        'application.modules.blog.*',
        'application.modules.blog.models.*',
        'application.modules.blog.widgets.*',
        'application.modules.blog.components.*',
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'SpaceMenuWidget', 'event' => 'onInit', 'callback' => array('BlogModule', 'onSpaceMenuInit')),
    ),
));
?>
