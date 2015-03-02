<div class="panel panel-default" id="blog-drafts-panel">

    <!-- Display panel menu widget -->
    <?php $this->widget('application.widgets.PanelMenuWidget', array('id' => 'blog-drafts-panel')); ?>

    <div class="panel-heading"><?php echo Yii::t('BlogModule.widgets_views_drafts', '<strong>My</strong> article drafts'); ?></div>
    <div class="panel-body" style="padding-top:0px;">
    
        
        <?php if (count($drafts) != 0) : ?>  
    
            <?php foreach ($drafts as $draft) : ?>

                <div style="padding-left:10px;">
                    <i class="fa fa-pencil-square-o"></i>
                    
                    <a href="<?php echo Yii::app()->createUrl($draft->editRoute, array('id' => $draft->id, 'sguid' => $draft->content->container->guid))?>" class="blog-draft-shortmsg"> <?php echo $draft->title; ?></a> 
               
                </div>
             
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(count($drafts) == 0) { echo Yii::t('BlogModule', 'There are no drafts'); }?>
    </div>
</div>

 
<script type="text/javascript">
    var a = $('.blog-draft-shortmsg');
    var divw=a.parent().width();
    for (var i=0; i<a.length; i++){
        while ($(a[i]).outerWidth()>divw || $(a[i]).outerHeight()>18) {
            $(a[i]).text(function (index, text) {
                return text.replace(/\W*\s(\S)*$/, '...');
            });
        }
    }
</script>