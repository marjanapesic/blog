<div>

	<div class="panel panel-default" id="<?php echo $blog->getUniqueId(); ?>">
		<div class="panel-body">

            <div class="media" id="<?php echo $blog->getUniqueId()?>">

                <!-- Next and previous links -->
                <?php $nextBlog = $blog->getNextOrPrev("next");?>
                <?php $prevBlog = $blog->getNextOrPrev("prev");?>
                <?php if ($nextBlog || $prevBlog):?>
    			    <div class="media-body"> 
                        <?php if($nextBlog):?>
                            <div class="pull-right">
    						  <a href="<?php echo $nextBlog->getUrl();?>"><?php echo Yii::t('BlogModule.views_index_blog', "Next article")." "; ?><i class="fa fa-arrow-right"></i></a>
    					    </div>
        				<?php endif;?>
        					    
        				<?php if($prevBlog):?>
        				    <div class="pull-left">
    						  <a href="<?php echo $prevBlog->getUrl();?>"><i class="fa fa-arrow-left"></i><?php echo " ".Yii::t('BlogModule.views_index_blog', "Previous article"); ?></a>
    					   </div>
        			     <?php endif; ?>
    			     </div>
    				 <hr/>
				 <?php endif;?>
				
				 <?php $this->widget('application.modules.blog.widgets.BlogEntryControls', array('object' => $blog)); ?>

				 <!-- Blog content -->
				 <h2>
                    <a href="<?php echo $blog->getUrl()?>"> <strong><?php echo $blog->title; ?></strong></a>
				 </h2>
				 <p class="time">
					<small class="time">
                    	<?php echo HHtml::timeago($blog->created_at); ?>
                        
                        <?php if ($blog->created_at != $blog->updated_at): ?>
                            (<?php echo Yii::t('ForumModule.views_forum_post_layout', 'Updated :timeago', array (':timeago'=>HHtml::timeago($blog->updated_at))); ?>)
                        <?php endif; ?>
                    </small>
				 </p>

				 <div class="content" id="blog_content_<?php echo $blog->getUniqueId(); ?>">
                    <span id="blog-content-<?php echo $blog->id; ?>" style="display: block;">
                        <?php echo nl2br(trim(MarkdownViewHelper::getInstance()->parseMarkdown($blog->message))); ?>
                    </span>
         
                    <hr />
                 </div>
                
                 <!-- Author -->
				 <a class="pull-left" href="<?php echo $blog->user->getUrl()?>"><img
					class="media-object img-rounded user-image"
					data-src="holder.js/64x64" alt="64x64"
					style="width: 50px; height: 50px;"
					src="<?php echo $blog->user->getProfileImage()->getUrl(); ?>"></a>

				 <div class="media-body">
					<h5 style="font-weight: bold; margin: 0px"><?php echo Yii::t('BlogModule.views_index_blog', "Author").":";?></h5>
					<h5 style="margin: 0px""><a href="<?php echo $blog->user->getProfileUrl(); ?>"><?php echo CHtml::encode($blog->user->displayName); ?></a></h5>
					<h5 style="margin: 0px"><?php echo CHtml::encode($blog->user->profile->title); ?></h5>
				 </div>
				 <hr/>  
                            
                 <?php $this->widget('application.modules_core.wall.widgets.WallEntryAddonWidget', array('object' => $blog)); ?>
			</div>

		</div>
	</div>

</div>