<?php

class IndexController extends Controller
{
       
    public function actionPreview()
    {
        $this->forcePostRequest();
        $content = Yii::app()->request->getParam('markdown');
        $this->renderPartial('preview', array('content' => $content));
    }
    
}