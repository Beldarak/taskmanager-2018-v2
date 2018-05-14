<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use app\models\Tmuser; 
use app\models\Task;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_description')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'task_creator')->textInput() ?>-->

    <?= $form->field($model, 'task_creator')->dropDownList(
            ArrayHelper::map(Tmuser::find()->all(),'tmuser_id','tmuser_login'),
            ['prompt'=>'Select Task Creator'])?>

    <!--<?= $form->field($model, 'task_parent')->textInput() ?>-->
    <?= $form->field($model, 'task_parent')->dropDownList(
            ArrayHelper::map(Task::find()->all(),'task_id','task_name'),
            ['prompt'=>'Select Parent Task (if needed)'])?>

    <!--<?= $form->field($model, 'task_limit')->textInput() ?>-->

    <?= $form->field($model, 'task_limit')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'task_status')->checkbox(['label'=>'Finished?']) ?>

    <?= $form->field($model, 'task_emergency')->checkbox(['label'=>'Emergency?']) ?>

    <?= $form->field($model, 'task_end')->textInput() ?>

    <?= $form->field($model, 'task_priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
