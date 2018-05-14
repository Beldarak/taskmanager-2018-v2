<?php

namespace app\controllers;

use Yii;
use app\models\TmuserTask;
use app\models\TmuserTaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TmuserTaskController implements the CRUD actions for TmuserTask model.
 */
class TmuserTaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TmuserTask models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TmuserTaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TmuserTask model.
     * @param integer $tmuser_task_task
     * @param integer $tmuser_task_tmuser
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tmuser_task_task, $tmuser_task_tmuser)
    {
        return $this->render('view', [
            'model' => $this->findModel($tmuser_task_task, $tmuser_task_tmuser),
        ]);
    }

    /**
     * Creates a new TmuserTask model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TmuserTask();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tmuser_task_task' => $model->tmuser_task_task, 'tmuser_task_tmuser' => $model->tmuser_task_tmuser]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TmuserTask model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $tmuser_task_task
     * @param integer $tmuser_task_tmuser
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tmuser_task_task, $tmuser_task_tmuser)
    {
        $model = $this->findModel($tmuser_task_task, $tmuser_task_tmuser);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tmuser_task_task' => $model->tmuser_task_task, 'tmuser_task_tmuser' => $model->tmuser_task_tmuser]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TmuserTask model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $tmuser_task_task
     * @param integer $tmuser_task_tmuser
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tmuser_task_task, $tmuser_task_tmuser)
    {
        $this->findModel($tmuser_task_task, $tmuser_task_tmuser)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TmuserTask model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $tmuser_task_task
     * @param integer $tmuser_task_tmuser
     * @return TmuserTask the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tmuser_task_task, $tmuser_task_tmuser)
    {
        if (($model = TmuserTask::findOne(['tmuser_task_task' => $tmuser_task_task, 'tmuser_task_tmuser' => $tmuser_task_tmuser])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
