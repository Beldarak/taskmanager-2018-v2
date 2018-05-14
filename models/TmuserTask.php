<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tmuser_task".
 *
 * @property int $tmuser_task_task
 * @property int $tmuser_task_tmuser
 * @property int $tmuser_task_order
 *
 * @property Tmuser $tmuserTaskTmuser
 * @property Task $tmuserTaskTask
 */
class TmuserTask extends \yii\db\ActiveRecord
{

    public $user;
    public $task;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tmuser_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmuser_task_task', 'tmuser_task_tmuser', 'tmuser_task_order'], 'required'],
            [['tmuser_task_task', 'tmuser_task_tmuser', 'tmuser_task_order'], 'integer'],
            [['tmuser_task_task', 'tmuser_task_tmuser'], 'unique', 'targetAttribute' => ['tmuser_task_task', 'tmuser_task_tmuser']],
            [['tmuser_task_tmuser'], 'exist', 'skipOnError' => true, 'targetClass' => Tmuser::className(), 'targetAttribute' => ['tmuser_task_tmuser' => 'tmuser_id']],
            [['tmuser_task_task'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['tmuser_task_task' => 'task_id']],
            [['user', 'task'], 'safe'],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->user = $this->tmuserTaskTmuser;
        $this->task = $this->tmuserTaskTask;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tmuser_task_task' => Yii::t('app', 'Tmuser Task Task'),
            'tmuser_task_tmuser' => Yii::t('app', 'Tmuser Task Tmuser'),
            'tmuser_task_order' => Yii::t('app', 'Tmuser Task Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmuserTaskTmuser()
    {
        return $this->hasOne(Tmuser::className(), ['tmuser_id' => 'tmuser_task_tmuser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmuserTaskTask()
    {
        return $this->hasOne(Task::className(), ['task_id' => 'tmuser_task_task']);
    }
}
