
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\MySortableGridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

    <h3> 
        <?= Yii::t('app','Projects can be moved :');?>
    </h3></br>
    
    <?= MySortableGridView::widget([
    'dataProvider' => $dataProvider2,
    
    'sortUrl' => Yii::$app->urlManager->createUrl('/site/sortItem'),
    
    'columns' => [
        /*
        [
            'attribute'=>'tmuser_task_order',
            'value'=>'tmuser_task_order'
        ],
        */
        [
            'attribute'=>'user',
            'value'=>'user.tmuser_name'
        ],
        [
            'attribute'=>'task',
            'value'=>'task.task_name',
			//'htmlOptions'=>array('class'=>'david','data-id'=>'task.task_id')
        ]
		
    ],
	'rowOptions' => function ($model, $key, $index, $grid) {
		return ['class'=>'david', 'data-id'=>$model->tmuser_task_task];
	}
    ]); 
	

    /*
        'task_id',
        'task_name',
        'task_description',
        'task_creator',
        'task_parent',
        'task_limit',
        'task_status',
        'task_emergency',
        'task_end',
        'task_priority',
        'order',
    */?>
    
    
    <h3> 
        <?= Yii::t('app','Tasks can be moved :');?>
    </h3></br>
    
    <?= MySortableGridView::widget([
    'dataProvider' => $dataProvider3,
    
    'sortUrl' => Url::to(['sortItem']),
    
    'columns' => [
        /*
        [
            'attribute'=>'tmuser_task_order',
            'value'=>'tmuser_task_order'
        ],
        */
        [
            'attribute'=>'user',
            'value'=>'user.tmuser_name'
        ],
        [
            'attribute'=>'task',
            'value'=>'task.task_name'
        ]
    ],
    ]); 
	/*
	$this->registerJs("
		$('.david').on('click', function (evt) {
			console.log($(this).closest('tr').data('id'));			
		});
		
		$.ajax({
			url: "'.Yii::$app->urlManager->createUrl('site/display-concerned-tasks').'",
			method: "POST",
			data: { id: $(this).val() }
		})
		.done(function( data ) {
			$( "select#'.Html::getInputId($modelDet, 'id').'").html( data );
		})
		.fail(function(xhr,status,error) { // récupérer la réponse
			alert(status+\' : \'+xhr.responseText); // afficher cette réponse
		});
	
	");
	*/
	?>