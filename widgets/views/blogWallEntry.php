<div class="panel panel-default blog" id="post-<?php echo $blog->id; ?>">
	<div class="panel-body">
        <?php $this->beginContent('application.modules_core.wall.views.wallLayout', array('object' => $blog)); ?>
        <i class="icon-comments"></i>
		<div style="overflow: hidden; margin: 5px;">
			<span>
    			<?php
                echo Yii::t('BlogModule.widgets_views_blogWallEntry', '{userDisplayName} published new article in space blog', array(
                    '{userDisplayName}' => CHtml::encode($user->displayName)
                ));
                ?> 
            </span> 
            <br/>
            
			<table>
				<tr>
					<td class="wall-comment-icon" >
					   <i class="fa fa-comments"></i>
					</td>
					
					<td style="padding-left: 15px; padding-right: 15px;">
					   <span style="font-weight: bold; font-size: 16px;"><?php print HHtml::enrichText($blog->title); ?></span>
						<div id="blog-message-<?php echo $blog->id;?>"
							style="max-height: 75px; overflow: hidden;">
							<span>
                            <?php print MarkdownViewHelper::getInstance()->getPlainText($blog->message); ?>
                            </span>
						</div> 
						<a class="more-link-post" style="margin: 20px 0 20px 0; font-weight: bold;"	href="<?php echo $blog->getUrl();?>">
						  <?php echo Yii::t('BlogModule.widgets_views_blogWallEntry', 'Read full article'); ?>
                        </a>
        
					</td>
			
			</table> 
			
            <hr/>
		</div>
       
        
        <?php $this->endContent(); ?>
    </div>
</div>
<script type="text/javascript">
    var p = $('#blog-message-<?php echo $blog->id ?> span');
    var divh=$('#blog-message-<?php echo $blog->id ?>').height();
    while ($(p).outerHeight()>divh) {
        $(p).text(function (index, text) {
            return text.replace(/\W*\s(\S)*$/, '...');
        });
    }
</script>