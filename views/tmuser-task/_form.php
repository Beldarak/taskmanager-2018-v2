<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TmuserTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmuser-task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tmuser_task_task')->textInput() ?>

    <?= $form->field($model, 'tmuser_task_tmuser')->textInput() ?>

    <?= $form->field($model, 'tmuser_task_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
