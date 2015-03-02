<?php

/**
 * This widget is used to show a blog wall entry
 *
 * @package humhub.modules.blog.widgets
 * @since 0.10
 */
class BlogWallEntryWidget extends HWidget
{

    /**
     * The blog object
     *
     * @var Blog
     */
    public $blog;

    /**
     * Executes the widget.
     */
    public function run()
    {

        $user = $this->blog->user;

        $this->render('blogWallEntry', array(
            'blog' => $this->blog,
            'user' => $user
        ));
    }

}

?>