<?php

class IndexController extends Controller
{

    public $subLayout = "__layout";
    
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
    
        $topicsPerPage = 10;
    
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
         
        $topicsPerPage = 10;
        
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
        
        $criteria=new CDbCriteria();
        $criteria->addCondition("published IS NOT NULL");
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
        
        $output = $this->render('index', array(
            'blogs' => $blogs,
            'pages' => $pages
        ));
         
    }
    
    
    public function actionCreate()
    {
        
        $guid = Yii::app()->request->getQuery('guid');
        $blog = Blog::model()->findByAttributes(array('guid' => $guid));
        
        if($blog == null)
            $blog = new Blog();   
        
        if (isset($_POST['Blog'])) {
            $_POST['Blog'] = Yii::app()->input->stripClean($_POST['Blog']);
            $blog->attributes = $_POST['Blog'];
           
            $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
            $blog->content->visibility=1;
            $blog->content->container = $user;
        
            if ($blog->validate()) {
                if(!$blog->published)
                    $blog->published = (int)$_POST['publish'] ? new CDbExpression('NOW()') : null;
                $blog->save();
                $blog = Blog::model()->findByPk($blog->id);
                return $this->htmlRedirect($blog->getUrl());
            }
        }
       
        $blog->message = $this->parseMarkdown($blog->message);

        $this->render('create', array('model' => $blog));
    }
    
    public function actionBlog() {
        
        $guid = Yii::app()->request->getQuery('guid');
        
        // Try Load the space
        $blog = Blog::model()->findByAttributes(array('guid' => $guid));
        if($blog == null)
            throw new CHttpException(404, Yii::t('BlogModule.controller_IndexController', 'Blog post not found!'));
        
        if($blog->published == null){
            return $this->redirect($this->createUrl('//blog/index/create', array('guid' => $blog->guid)));
        }
      
        $blog->message = $this->parseMarkdown($blog->message);
        $this->render('blog', array('blog' => $blog));
    }
    
    
    public function actionDelete() {
        
        $this->forcePostRequest();
        
        // Json Array
        $json = array();
        $json['success'] = false;
        
        $model = Yii::app()->request->getParam('model', "");
        $id = (int) Yii::app()->request->getParam('id');
        
        $content = Content::get($model, $id);
        
        if ($content->content->canDelete()) {
        
            if ($content->delete()) {
                if($model=="Blog"){
                    return $this->htmlRedirect($this->createUrl('//blog/index/index'));
                }
                $json['success'] = true;
            }
        
        }
        
        echo CJSON::encode($json);
        Yii::app()->end();
    }
    
//not finished
    public function actionEdit()
    {
        $guid = Yii::app()->request->getQuery('guid');

        // Try Load the space
        $blog = Blog::model()->findByAttributes(array('guid' => $guid));
        if($blog == null)
            throw new CHttpException(404, Yii::t('BlogModule.controller_IndexController', 'Blog post not found!'));
        

        $blog->message = $this->parseMarkdown($blog->message);       
        $this->render('create', array('model' => $blog));
    }
    
    public function actionDraft() {
        
        $topicsPerPage = 10;
        
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
         
        $topicsPerPage = 10;
        
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
        
        $criteria=new CDbCriteria();
        $criteria->addCondition("published IS NULL");
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
        
        $output = $this->render('index', array(
            'blogs' => $blogs,
            'pages' => $pages
        ));
    }
    
    public function actionPreview()
    {
        $this->forcePostRequest();
    
        $content = Yii::app()->request->getParam('markdown');
        $markdown = $this->parseMarkdown($content);
    
        $this->renderPartial('preview', array('content' => $markdown));
    }
    
    private function parseMarkdown($md)
    {
        $parser = new BlogMarkdown();
        $html = $parser->parse($md);
  
        $purifier = new CHtmlPurifier();
        return $purifier->purify($html);
    }
}