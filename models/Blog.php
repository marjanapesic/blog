<?php

/**
 * This is the model class for table "blog".
 *
 * The followings are the available columns in table 'blog':
 *         
 * @property integer $id
 * @property string $guid
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
    
    public $editRoute = '//blog/index/edit';

    public function behaviors()
    {
        return array(
            'HGuidBehavior' => array(
                'class' => 'application.behaviors.HGuidBehavior',
            ),
        );
    }
    
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
        return $this->createUrl('//blog/index/blog', $parameters);
    }

    
    public function createUrl($route, $params = array(), $ampersand = '&')
    {
        if (!isset($params['guid'])) {
            $params['guid'] = $this->guid;
        }
    
        if (Yii::app()->getController() !== null) {
            return Yii::app()->getController()->createUrl($route, $params, $ampersand);
        } else {
            return Yii::app()->createUrl($route, $params, $ampersand);
        }
    }
}