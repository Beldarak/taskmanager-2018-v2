<?php

namespace app\models;

use Yii;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tmuser".
 *
 * @property int $tmuser_id
 * @property string $tmuser_name
 * @property string $tmuser_first_name
 * @property string $tmuser_login
 * @property string $tmuser_password
 * @property int $tmuser_role
 * @property int $tmuser_type
 *
 * @property Task[] $tasks
 * @property TmuserTask[] $tmuserTasks
 * @property Task[] $tmuserTaskTasks
 */
class Tmuser extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tmuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmuser_name', 'tmuser_first_name', 'tmuser_login', 'tmuser_password'], 'required'],
            [['tmuser_role', 'tmuser_type'], 'integer'],
            [['tmuser_name', 'tmuser_first_name', 'tmuser_login', 'tmuser_password'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tmuser_id' => Yii::t('app', 'Tmuser ID'),
            'tmuser_name' => Yii::t('app', 'Tmuser Name'),
            'tmuser_first_name' => Yii::t('app', 'Tmuser First Name'),
            'tmuser_login' => Yii::t('app', 'Tmuser Login'),
            'tmuser_password' => Yii::t('app', 'Tmuser Password'),
            'tmuser_role' => Yii::t('app', 'Tmuser Role'),
            'tmuser_type' => Yii::t('app', 'Tmuser Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['task_creator' => 'tmuser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmuserTasks()
    {
        return $this->hasMany(TmuserTask::className(), ['tmuser_task_tmuser' => 'tmuser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmuserTaskTasks()
    {
        return $this->hasMany(Task::className(), ['task_id' => 'tmuser_task_task'])->viaTable('tmuser_task', ['tmuser_task_tmuser' => 'tmuser_id']);
    }

    //$tmuser->link('tasks', $task);

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();
    }

    public function getAuthKey(){
        throw new NotSupportedException();
    }

    public function validateAuthKey($authKey){
        throw new NotSupportedException();
    }
    
    public function getId(){
        return $this->tmuser_id;
    }
    
    public static function findByTmuserLogin($username){
        return self::findOne(['tmuser_login'=>$username]);
    }

    public function validatePassword($password){
        return $this->tmuser_password === $password;
    }
}
