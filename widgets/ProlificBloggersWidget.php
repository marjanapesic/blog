<?php

/**
 * This widget is used to show a prolific bloggers
 *
 * @package humhub.modules.blog.widgets
 * @since 0.10
 */
class ProlificBloggersWidget extends HWidget
{

    /**
     * Executes the widget.
     */
    public function run()
    {

        $cmd = Yii::app()->db->createCommand()
        ->select('user.*, count(*) as cnt')
        ->from('user')
        ->join('blog','blog.created_by = user.id and blog.published = 1 and blog.created_at >= NOW() - INTERVAL 30 DAY')
        ->join('content', 'content.object_model="Blog" and content.object_id=blog.id and content.space_id='.Yii::app()->getController()->getSpace()->id)
        ->group('user.id')
        ->having('cnt>0')
        ->order('cnt desc')
        ->limit(5);
  
        $userStats = $cmd->queryAll();        //the  params which will bind to ...
    
        $this->render('prolificBloggers', array(
            'userStats' => $userStats
        ));

    }

}

?>