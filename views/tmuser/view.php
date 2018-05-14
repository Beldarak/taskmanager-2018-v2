<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tmuser */

$this->title = $model->tmuser_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tmusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->tmuser_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->tmuser_id], [
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
            'tmuser_id',
            'tmuser_name',
            'tmuser_first_name',
            'tmuser_login',
            'tmuser_password',
            'tmuser_role',
            'tmuser_type',
        ],
    ]) ?>

</div>