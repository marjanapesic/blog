<link rel="stylesheet" href="<?php echo $this->getModule()->getAssetsUrl(); ?>/highlight.js/styles/zenburn.css">
<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/highlight.js//highlight.pack.js"></script>
    
<?php echo nl2br(trim(MarkdownViewHelper::getInstance()->parseMarkdown($content))); ?>

<script>

    $('pre code').each(function(i, e) {
        hljs.highlightBlock(e);
    });

</script>