<div class="blog">

    <a class="title" href="<?php echo $blog->getUrl()?>"><strong><?php echo $blog->title; ?></strong></a>

    <div class="media blog-list-entry" id="<?php echo $blog->getUniqueId()?>">
        
        <?php if (($imageSource = MarkdownViewHelper::getInstance()->getImageSource($blog->message))){?>
        	<img class="image pull-left"
        		data-src="holder.js/184x104" alt="184x104"
        		src="<?php print $imageSource; ?>">
        <?php
        }
        else{?>
        <div class="wall-comment-icon image pull-left">
            <i class="fa fa-comments"></i>
        </div>
        <?php }?>

    	<!-- show content -->
    	<div class = "content blog-text" >              
            <span class="time" title="<?php echo $blog->created_at; ?>"><?php echo $blog->created_at; ?></span>
            <p id="blog-message-<?php echo $blog->id?>" class="blog-message"><?php echo MarkdownViewHelper::getInstance()->getPlainText($blog->message); ?></p><br/>
            
            <a class="more-link-post" style="margin: 20px 0 20px 0; font-weight:bold;" href="<?php echo $blog->getUrl();?>">
                <?php echo Yii::t('BlogModule.views_blogEntry', 'Read more'); ?>
            </a>
            <span class="pull-right addon">
                <i class="fa fa-thumbs-up"></i><span><?php echo count(Like::GetLikes('Blog', $blog->id));?></span>
                <i class="fa fa-comments"></i><span><?php echo Comment::GetCommentCount('Blog', $blog->id);?></span></span>
    	</div>
    
     
    </div>
</div>
<hr/>

<script type="text/javascript">
    var p = $('#blog-message-<?php echo $blog->id?>');
    var divh=p.parent().height();
    while ($(p).outerHeight()>divh) {
        $(p).text(function (index, text) {
            return text.replace(/\W*\s(\S)*$/, '...');
        });
    }
</script>