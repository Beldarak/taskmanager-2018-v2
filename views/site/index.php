
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use richardfan\sortable\SortableGridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

    <h3> 
        <?= Yii::t('app','Projects can be moved :');?>
    </h3></br>
    
    <?= SortableGridView::widget([
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
            'value'=>'task.task_name'
        ]
    ],
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
    
    <?= SortableGridView::widget([
    'dataProvider' => $dataProvider3,
    
    'sortUrl' => Url::to(['sortItem']),
    
    'columns' => [
        'task_name',
        'task_description',
        'task_creator',
        'task_parent',
        'task_limit',
        'task_status',
        'task_emergency',
        'task_end',
        'task_priority',
    ],
    ]); ?>