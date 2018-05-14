<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Task;
use app\models\TaskSearch;
use app\models\TmuserTask;
use yii\web\NotFoundHttpException;
use richardfan\sortable\SortableAction;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'sortItem' => [
                'class' => SortableAction::className(),
                'activeRecordClassName' => TmuserTask::className(),
                'orderColumn' => 'tmuser_task_order',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if(Yii::$app->user->isGuest){
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }else{
            $user = Yii::$app->user->identity->tmuser_id;

            $searchModel = new TaskSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            $query2 = Task::find()
                    ->where('task_parent IS NULL');
            
            $query3 = Task::find()
                    ->where(['IS NOT', 'task_parent', null]);

            $query4 = TmuserTask::find()
                    ->select('tmuser_task.*,'
                        .'task.task_id as task_id, task.task_name as task_name')
                    ->leftJoin('task', 'task.task_id=tmuser_task.tmuser_task_task');

            $query4 = TmuserTask::find()
                    ->where('tmuser_task_task IS NOT NULL')
                    ->andFilterWhere(['tmuser_task_tmuser' => $user])
                    ->orderBy('tmuser_task_order', 'ASC');

            $query = TmuserTask::find()->select('tmuser_task.*,'
            . 't.task_id as TaskId, t.task_name as TaskName ')->
            leftJoin('task t', 't.task_id=tmuser_task.tmuser_task_task');

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $dataProvider->setSort([
            'attributes' => [
                'tmuser_task_task',
                'tmuser_task_tmuser',
                'tmuser_task_order',
                'TaskId',
                'TaskName']]);

            $query5 = Task::find()
                    ->viaTable('tmuser_task', ['task_id' => 'tmuser_task_task']);
              
            $dataProvider2 = new ActiveDataProvider([
                'query' => $query4
            ]);
            
            $dataProvider3 = new ActiveDataProvider([
                'query' => $query3
            ]);
            
            
            //$dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2, 
                'dataProvider3' => $dataProvider3,
            ]);
        }

        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
