<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TmuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tmusers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tmuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tmuser'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tmuser_id',
            'tmuser_name',
            'tmuser_first_name',
            'tmuser_login',
            'tmuser_password',
            //'tmuser_role',
            //'tmuser_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
