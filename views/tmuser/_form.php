<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tmuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tmuser_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmuser_first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmuser_login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmuser_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmuser_role')->textInput() ?>

    <?= $form->field($model, 'tmuser_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
