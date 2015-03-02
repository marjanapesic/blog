<div>
    <div class="panel panel-default">
		<div class="panel-body">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'blog-create-form',
                'enableAjaxValidation' => false,
                'action' => Yii::app()->createUrl('//blog/blog/create', array('sguid' => $this->contentContainer->guid))
            ));
            ?>

            <h4>
			<strong>
                <?php
                if (!$model->published)
                    echo Yii::t('BlogModule.views_index_create', "Create a new post");
                else
                    echo Yii::t('BlogModule.views_index_create', "Edit post");
                ?>
            </strong>
			</h4>
			<br />
			
			<div class="form-group">
                <?php  echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => Yii::t('BlogModule.base', 'New blog post title'))); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>
           
            
            <?php echo $form->labelEx($model, 'message');?>
            <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'id' => 'pageContentNewBlogPost', 'rows' => '15', 'placeholder' => Yii::t('BlogModule.base', 'Content')));?> 
            <?php $this->widget('application.modules.blog.widgets.MarkdownWidget', array('id' => 'NewBlogPost')); ?>
            
            <?php echo CHtml::hiddenField('publish', '');?>
            <?php echo CHtml::hiddenField('id', $model->id);?>
                   
            <?php echo CHtml::submitButton(Yii::t('BlogModule.base', 'Publish'), array('class' => 'btn btn-primary', 'id' => 'buttonPublish')); ?>
            <?php
            if (!$model->published) :
                echo CHtml::submitButton(Yii::t('BlogModule.base', 'Save to draft'), array(
                    'class' => 'btn btn-primary'
                ));
                if($model->id){
                    $this->widget('application.widgets.ModalConfirmWidget', array(
                        'uniqueID' => 'modal_blogdelete_'. $model->id,
                        'linkOutput' => 'a',
                        'title' => Yii::t('BlogModule.views_index_create', 'Confirm blog draft deletion'),
                        'message' => Yii::t('BlogModule.views_index_create', 'Are you sure you want to discard this draft?'),
                        'buttonTrue' => Yii::t('BlogModule.views_index_create', 'Disicard'),
                        'buttonFalse' => Yii::t('BlogModule.views_index_create', 'Cancel'),
                        'linkContent' => Yii::t('BlogModule.views_index_create', 'Discard'),
                        'linkHref' => Yii::app()->createUrl("//blog/blog/delete", array('id' => $model->id,'sguid' => $this->contentContainer->guid)),
                        'class' => 'btn btn-danger'
                    ));
                }
            endif;
            ?>
            <?php $this->endWidget(); ?>

       </div>
	</div>
</div>

<script>
$(document).ready(function () {
	$('#buttonPublish').click(function() {
	    $('#publish').val('1');
	});
});
</script>