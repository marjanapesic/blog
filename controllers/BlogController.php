<?php

class BlogController extends ContentContainerController
{
    
    
    public function init() 
    {
        parent::init();
        $this->subLayout = "_layout";    
    }
    
    public function filters()
    {
        return array(
            'accessControl'
        ); // perform access control for CRUD operations
    }
    
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    
    public function actionIndex(){
    
        $this->checkContainerAccess();
        
        /*if(!$this->contentContainer->isMember())
            return $this->redirect($this->createUrl('//space/space', array('sguid' => $this->contentContainer->guid)));*/
        
        $topicsPerPage = 10;
    
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
         
        $topicsPerPage = 10;
        
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
        
        $criteria=new CDbCriteria();
        $criteria->mergeWith(array(
            'join'=>'LEFT JOIN content ON content.object_model = "Blog" and content.object_id = t.id',
        ));
        $criteria->addCondition("published = 1");
        $criteria->addCondition("content.space_id = ".$this->contentContainer->id);
        $criteria->order = 'updated_at DESC';
        
        $blogs = Blog::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($blogs, array(
            'id' => 'id',
            'pagination' => array(
                'pageSize' => 10
            )
        ));
        
        $blogs = $dataProvider->getData();
        $pages = $dataProvider->getPagination();
        
        $this->render('index', array(
            'blogs' => $blogs,
            'pages' => $pages
        ));
         
    }
    
    
    public function actionCreate()
    {
        $this->checkContainerAccess();
        
       /* if(!$this->contentContainer->isMember())
            return $this->redirect($this->createUrl('//space/space', array('sguid' => $this->contentContainer->guid)));*/
        
        $id = Yii::app()->request->getParam('id');
        $blog = Blog::model()->findByAttributes(array('id' => $id));
        
        if($blog == null)
            $blog = new Blog();   
        
        if (isset($_POST['Blog'])) {
            $_POST['Blog'] = Yii::app()->input->stripClean($_POST['Blog']);
            $blog->attributes = $_POST["Blog"];
           
            $blog->content->container = $this->contentContainer;
            if ($blog->validate()) {
                
                if(!$blog->published && (int)$_POST['publish']){
                    $blog->published = 1;
                    $blog->created_at = new CDbExpression('NOW()');
                }
    
                $blog->save();
                if(!$blog->published)
                    return $this->redirect($this->createUrl('//blog/blog/index', array('sguid' => $this->contentContainer->guid)));
                $blog = Blog::model()->findByPk($blog->id);
                return $this->htmlRedirect($blog->getUrl());
            }
        }

        $this->render('create', array('model' => $blog, 'sguid' => $this->contentContainer->guid));
    }
    
    public function actionBlog() {
        
        $this->checkContainerAccess();
        
        /*if(!$this->contentContainer->isMember())
            return $this->redirect($this->createUrl('//space/space', array('sguid' => $this->contentContainer->guid)));*/
        
        $id = Yii::app()->request->getQuery('id');
            
        // Try Load the space
        $blog = Blog::model()->findByAttributes(array('id' => $id));
        if($blog == null)
            throw new CHttpException(404, Yii::t('BlogModule.controller_IndexController', 'Blog post not found!'));
        
        if($blog->published == null){
            return $this->redirect($this->createUrl('//blog/blog/create', array('guid' => $blog->guid)));
        }

        $this->render('blog', array('blog' => $blog));
    }
    
    
    public function actionDelete() {
        
         $this->checkContainerAccess();
        
        /*if(!$this->contentContainer->isMember())
            return $this->redirect($this->createUrl('//space/space', array('sguid' => $this->contentContainer->guid)));*/
        
        $this->forcePostRequest();
        
        // Json Array
        $json = array();
        $json['success'] = false;
        
        $id = (int) Yii::app()->request->getParam('id');
        
       // $content = Content::get($model, $id);
        $blog = Blog::model()->findByPk($id);
        
        if ($blog->content->canDelete() && $blog->delete()) {
            return $this->htmlRedirect($this->createUrl('//blog/blog/index', array('sguid'=> $this->contentContainer->guid)));
        }
        
       return $this->htmlRedirect($this->createUrl('//blog/blog/blog', array('id' => $blog->id, 'sguid'=> $this->contentContainer->guid)));
    }
    
    
    public function actionEdit()
    {
        $this->checkContainerAccess();
        
      /*  if(!$this->contentContainer->isMember())
            return $this->redirect($this->createUrl('//space/space', array('sguid' => $this->contentContainer->guid)));*/
    
        $id = Yii::app()->request->getQuery('id');

        // Try Load the space
        $blog = Blog::model()->findByAttributes(array('id' => $id));
        if($blog == null)
            throw new CHttpException(404, Yii::t('BlogModule.controller_IndexController', 'Blog post not found!'));
        if(!$blog->content->canWrite())
            throw new CHttpException(403, Yii::t('BlogModule.controller_IndexController', 'Access denied!'));
        
        $this->render('create', array('model' => $blog, 'sguid' => $blog->content->container->guid));
    }
}