<?php

namespace app\controllers;

use app\models\Task;
use app\models\Tmuser;

use yii\helpers\ArrayHelper;


class TaskManagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$me = Tmuser::findOne(1);
    	$tasks = $me->tmuserTaskTasks;
        return $this->render('index', ['model' => $tasks]);
    }

}
