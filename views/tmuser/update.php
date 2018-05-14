<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tmuser */

$this->title = Yii::t('app', 'Update Tmuser: ' . $model->tmuser_id, [
    'nameAttribute' => '' . $model->tmuser_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tmuser_id, 'url' => ['view', 'id' => $model->tmuser_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tmuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
