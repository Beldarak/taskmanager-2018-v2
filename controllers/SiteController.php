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
	
	public $currentProject = null;
	
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
            
            if ($this->currentProject != null)
			{
				$subQuery = Task::find()
							->select('task_id')
							->where(['task_parent' => $currentProject->tmuserTaskTask]);
							
				$subQueryNull = Task::find()
							->select('task_id')
							->where('task_parent IS NULL');
							
								
				$query3 = TmuserTask::find()
						  ->andFilterWhere(['tmuser_task_tmuser' => $user])
						  ->andFilterWhere(['in', 'tmuser_task_task', $subQuery])
						  ->orderBy('tmuser_task_order', 'ASC');


				$query4 = TmuserTask::find()
						->andFilterWhere(['tmuser_task_tmuser' => $user])
						->andFilterWhere(['in', 'tmuser_task_task', $subQueryNull])
						->orderBy('tmuser_task_order', 'ASC');

				$dataProvider2 = new ActiveDataProvider([
					'query' => $query4
				]);
				
				$dataProvider3 = new ActiveDataProvider([
					'query' => $query3
				]);
				
				
				//$dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);

				return $this->render('index', [
					'searchModel' => $searchModel,
					'dataProvider2' => $dataProvider2, 
					'dataProvider3' => $dataProvider3,
				]);
			}
			else
			{
				
				$subQuery = Task::find()
							->select('task_id')
							->where('task_parent IS NOT NULL');
							
				$subQueryNull = Task::find()
							->select('task_id')
							->where('task_parent IS NULL');
							
								
				$query3 = TmuserTask::find()
						  ->andFilterWhere(['tmuser_task_tmuser' => $user])
						  ->andFilterWhere(['in', 'tmuser_task_task', $subQuery])
						  ->orderBy('tmuser_task_order', 'ASC');


				$query4 = TmuserTask::find()
						->andFilterWhere(['tmuser_task_tmuser' => $user])
						->andFilterWhere(['in', 'tmuser_task_task', $subQueryNull])
						->orderBy('tmuser_task_order', 'ASC');

				$dataProvider2 = new ActiveDataProvider([
					'query' => $query4
				]);
				
				$dataProvider3 = new ActiveDataProvider([
					'query' => $query3
				]);
				
				
				//$dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);

				return $this->render('index', [
					'searchModel' => $searchModel,
					'dataProvider2' => $dataProvider2, 
					'dataProvider3' => $dataProvider3,
				]);
			}
					

				
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
	
	public function actionDisplayConcernedTasks(){
		if (Yii::$app->request->isAjax) {
		
			$data = Yii::$app->request->post();
			
			if ($data['id']) {
				$tasks = array();
				$results = $tasks->getTasks->where(['task_parent' => $data['id']]);
				/*
				if (count($results) > 0) {
					foreach ($results as $result) {
						echo '<div value="'.$result->id.'">'.$result->nom.'</div>';
					}
				} else {
					echo '<option>Aucun aliment à sélectionner</option>';
				}*/

			} else {
				echo '<div>' . Yii::t('app','No task found for this project') . '</div>';
			}
			
        }
	}
}
