<div class="container">

	<div class="row">
		<div class="col-md-8">
			<div class="s2-streamContent">

    			<div class="wall-entry">
				

                    <div class="panel panel-default post" id="<?php echo $blog->getUniqueId(); ?>">
                        <div class="panel-body">

                            <div class="media" id="<?php echo $blog->getUniqueId()?>">
                            
                                <h4><a href="<?php echo $blog->getUrl()?>"><strong><?php echo $blog->title; ?>
                                                                </strong></a> <br /></h4>
                            	
                            	<img class="media-object img-rounded pull-left"
                            		data-src="holder.js/32x32" alt="32x32"
                            		style="width: 32px; height: 32px;"
                            		src="<?php echo $blog->user->getProfileImage()->getUrl(); ?>">
                            
                            	<!-- show content -->
                            	<div class="media-body">
                            	    <a href="<?php echo $blog->content->user->getProfileUrl(); ?>"><?php echo CHtml::encode($blog->content->user->displayName); ?></a> 
                            	    <br/>
                            		
                            
                            		<h5><?php echo CHtml::encode($blog->content->user->profile->title); ?></h5>
                            	</div>
                            	<hr />
                            
                            	<div class="content"
                            		id="wall_content_<?php echo $blog->getUniqueId(); ?>">
                            		<?php 
                        
                            		if(@isset($edit) && $edit) {?>
                                      
                            		<?php 
                            		}
                            		
                            		else {?>
                                		<span id="post-content-<?php echo $blog->id; ?>" style="display: block;">
                                            <?php echo nl2br(trim($blog->message)); ?>
                                        </span>
                                    <?php }?>
                                    
                            	</div>
                            </div>

                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
        </div>
    </div>
    
</div>