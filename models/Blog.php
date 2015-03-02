<?php

/**
 * This is the model class for table "blog".
 *
 * The followings are the available columns in table 'blog':
 *         
 * @property integer $id
 * @property string $title
 * @property string $message
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.blog.models
 * @since 0.10
 */
class Blog extends HActiveRecordContent
{
    public $autoAddToWall = false;
    public $editRoute = '//blog/blog/edit';
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ForumComment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'blog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('title, message, created_at, updated_at', 'safe'),
            array('title, message', 'required'),
            array('title', 'length', 'max' => 255),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(static::BELONGS_TO, 'User', 'created_by'),
        );
    }

    
    public function attributeLabels()
    {
        return array(
            'title' => Yii::t('BlogModule.models_Blog', 'Title'),
            'message' => Yii::t('BlogModule.models_Blog', 'Post'),
        );
    }
    
    
    public function getUrl($parameters = array())
    {
        return $this->createUrl('//blog/blog/blog', $parameters);
    }

    
    public function createUrl($route, $params = array(), $ampersand = '&')
    {
        if (!isset($params['id'])) {
            $params['id'] = $this->id;
        }
        
        if (!isset($params['sguid'])) {
            $params['sguid'] = $this->content->container->guid;
        }
    
        if (Yii::app()->getController() !== null) {
            return Yii::app()->getController()->createUrl($route, $params, $ampersand);
        } else {
            return Yii::app()->createUrl($route, $params, $ampersand);
        }
    }
    
    
    public function canDelete($userId = "")
    {
        if ($userId == "")
            $userId = Yii::app()->user->id;

        if ($this->created_by == $userId)
            return true;
        
        if (Yii::app()->user->isAdmin()) {
            return true;
        }

        return false;
    }
    
    public function canWrite($userId = "")
    {
        if ($userId == "")
            $userId = Yii::app()->user->id;
    
        if ($this->created_by == $userId)
            return true;
    
        return false;
    }
    
    
    public function getWallOut()
    {
        return Yii::app()->getController()->widget('application.modules.blog.widgets.BlogWallEntryWidget', array('blog' => $this), true);
    }
    
    public function getContentTitle()
    {
        return Yii::t('BlogModule.models_Blog', 'article') . " \"" . Helpers::truncateText($this->title, 60) . "\"";
    }
   
    
    public function afterSave()
    {
    
        parent::afterSave();
    
        if ($this->published && $this->created_at == $this->updated_at) {
            $activity = Activity::CreateForContent($this);
            $activity->type = "BlogCreated";
            $activity->module = "blog";
            $activity->save();
            $activity->fire();
            
            $this->content->addToWall();
        }
        
        return true;
    }
    
    public function getNextOrPrev($nextOrPrev)
    {
        if ($nextOrPrev == "prev")
            $order = "updated_at ASC";
        if ($nextOrPrev == "next")
            $order = "updated_at DESC";
        
        $criteria = new CDbCriteria();
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN content ON content.object_model = "Blog" and content.object_id = t.id'
        ));
        $criteria->addCondition("published IS NOT NULL");
        $criteria->addCondition("content.space_id = " . $this->content->container->id);
        $criteria->order = $order;
        
        $blogs = Blog::model()->findAll($criteria);
        
        foreach ($blogs as $i => $r) {
            if ($r->id == $this->id) {
                return isset($blogs[$i + 1]) ? $blogs[$i + 1] : NULL;
            }
        }
        
        return null;
    }
}