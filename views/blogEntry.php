<div class="media" id="<?php echo $blog->getUniqueId()?>">

	<img class="media-object img-rounded pull-left"
		data-src="holder.js/32x32" alt="32x32"
		style="width: 32px; height: 32px;"
		src="<?php echo $blog->user->getProfileImage()->getUrl(); ?>">

	<!-- show content -->
	<div class="media-body">

		<ul class="nav nav-pills" style="position: absolute; right: 10px;">
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
				<ul class="dropdown-menu pull-right">
                    <?php $this->widget('application.modules.blog.widgets.BlogEntryControls', array('object' => $blog)); ?>
                </ul>
            </li>
		</ul>
		<a href="<?php echo $blog->getUrl()?>"><strong><?php echo $blog->title; ?></strong></a>

		<br /> <span class="time"><?php echo Yii::t('BlogModule.views_blogEntry', 'started by')?> </span> <?php echo " ".$blog->user->username;?> 
                            
        <span class="time" title="<?php echo $blog->created_at; ?>"><?php echo $blog->created_at; ?></span>
	</div>

	<hr />
</div>