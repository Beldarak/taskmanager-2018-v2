<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TmuserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmuser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tmuser_id') ?>

    <?= $form->field($model, 'tmuser_name') ?>

    <?= $form->field($model, 'tmuser_first_name') ?>

    <?= $form->field($model, 'tmuser_login') ?>

    <?= $form->field($model, 'tmuser_password') ?>

    <?php // echo $form->field($model, 'tmuser_role') ?>

    <?php // echo $form->field($model, 'tmuser_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
