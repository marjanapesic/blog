<div class="container">

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">

				<div class="panel-heading">
                    <?php echo Yii::t('BlogModule.views_index_index', 'Blog'); ?>
                    <div class='pull-right'>
                        <?php echo HHtml::link(Yii::t('BlogModule.views_index_index', 'New post'), $this->createUrl('//blog/index/create'))?>
                    </div>

				</div>


				<div class="panel-body">

					<hr>
					<?php if(count($blogs) ==0) echo Yii::t('BlogModule.view_index_index', "There are no posts yet."); ?>
		            <?php foreach ($blogs as $blog) {?>
            
                            <?php $this->renderPartial('/blogEntry', array('blog' => $blog));?>
                            
                        <?php }?>
               
					<div class="pagination-container">
                            <?php
                            $this->widget('CLinkPager', array(
                                'maxButtonCount' => 5,
                                'pages' => $pages,
                                'maxButtonCount' => 5,
                                'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                                'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                                'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                                'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                                'header' => '',
                                'htmlOptions' => array(
                                    'class' => 'pagination'
                                ),
                                'id' => 'link_pager'
                            ));
                            ?>
                     </div>
				</div>
				
				<div class="panel-footer" style="padding: 0px">
                    <div class="pagination-container">
                        <?php
                        $this->widget('CLinkPager', array(
                            'pages' => $pages,
                            'maxButtonCount' => 10,
                            'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                            'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                            'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                            'header' => '',
                            'htmlOptions' => array(
                                'class' => 'pagination'
                            ),
                            'id' => 'link_pager'
                        ));
                        ?>
                    </div>
                </div>
			</div>

		</div>
	</div>

</div>