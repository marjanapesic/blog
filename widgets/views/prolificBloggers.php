<div class="panel panel-default" id="prolific-bloggers-panel">

    <!-- Display panel menu widget -->
    <?php $this->widget('application.widgets.PanelMenuWidget', array('id' => 'prolific-bloggers-panel')); ?>

    <div class="panel-heading"><?php echo Yii::t('BlogModule.widgets_views_prolificBloggers', '<strong>Prolific</strong> bloggers (Past 30 days)'); ?></div>
    <div class="panel-body">
        <?php if (count($userStats) != 0) : ?>  
    
            <?php foreach ($userStats as $userStat) : ?>
                <?php $user = User::model()->findByPk($userStat['id']); ?>
                <div class="media">
                    <a href="<?php echo $user->getProfileUrl(); ?>" class="pull-left">
                        <img src="<?php echo $user->getProfileImage()->getUrl(); ?>" class="media-object img-rounded"
                             height="48" width="48" alt="48x48" data-src="holder.js/48x48">
                    </a>
                    
                    <div class="media-body">
                        <strong><?php echo CHtml::encode($user->displayName); ?></strong>
                        <span class="pull-right" style="padding-right: 10px;"> <?php echo $userStat['cnt'];?></span>
                        <br><?php echo CHtml::encode($user->profile->title); ?>
                       
                    </div>
                </div>
             
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(count($userStats) == 0) { echo Yii::t('BlogModule.widgets_views_prolificBloggers', 'No posts created within last 30 days'); }?>
    </div>
</div>