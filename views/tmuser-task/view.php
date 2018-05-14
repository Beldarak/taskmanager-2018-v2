<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TmuserTask */

$this->title = $model->tmuser_task_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmuser Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmuser-task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'tmuser_task_task' => $model->tmuser_task_task, 'tmuser_task_tmuser' => $model->tmuser_task_tmuser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'tmuser_task_task' => $model->tmuser_task_task, 'tmuser_task_tmuser' => $model->tmuser_task_tmuser], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tmuser_task_task',
            'tmuser_task_tmuser',
            'tmuser_task_order',
        ],
    ]) ?>

</div>
