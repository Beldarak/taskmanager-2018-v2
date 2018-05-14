<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tmuser */

$this->title = Yii::t('app', 'Create Tmuser');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
