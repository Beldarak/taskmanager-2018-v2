<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TmuserTask */

$this->title = Yii::t('app', 'Update Tmuser Task: ' . $model->tmuser_task_task, [
    'nameAttribute' => '' . $model->tmuser_task_task,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmuser Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tmuser_task_task, 'url' => ['view', 'tmuser_task_task' => $model->tmuser_task_task, 'tmuser_task_tmuser' => $model->tmuser_task_tmuser]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tmuser-task-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
