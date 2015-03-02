<?php $this->beginContent('application.modules_core.activity.views.activityLayout', array('activity' => $activity)); ?>

<?php echo Yii::t('BlogModule.views_activities_Blog', '{userDisplayName} has published article "{contentTitle}"', array(
    '{userDisplayName}' => '<strong>' . CHtml::encode($user->displayName) . '</strong>',
    '{contentTitle}' => ActivityModule::formatOutput($target->title),
)); ?>

<?php $this->endContent(); ?>
