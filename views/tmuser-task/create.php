<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TmuserTask */

$this->title = Yii::t('app', 'Create Tmuser Task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmuser Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmuser-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
