<?php

namespace cubiclab\project\models;

use Yii;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%cprj_projects}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $created
 * @property integer $responsible_user
 */
class Project extends \yii\db\ActiveRecord
{

    public $tasks;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cprj_projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status', 'created', 'responsible_user'], 'required'],
            [['status', 'responsible_user'], 'integer'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'created' => 'Created',
            'responsible_user' => 'Responsible User',
        ];
    }

    /**
     * @inheritdoc
     * @return ProjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    public static function getProjectName($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model->name;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getProjectArr()
    {
        $model = new Project();
        $listData = ArrayHelper::map($model->find()->all(), 'id', 'name');
        return $listData;
    }

    public static function getStatusText($status)
    {
        $query = new Query();
        $query->select(['name'])
            ->from(['cprj_projectstatus'])
            ->limit(1)
            ->where(['id' => $status]);
        return $query->one()['name'];
    }

    public function getTasks($projectid)
    {
        if (!isset($projectid)) {
            return false;
        }
        $query = new ActiveQuery(new Task);
        return $query->where(['projectID' => $projectid])->all();
    }

    public static function getTaskModel($id)
    {
        if (!isset($id)) {
            return false;
        }

        $query = new ActiveQuery(new Task);
        return $query->where(['id' => $id])->one();
    }


}
