<?php

namespace cubiclab\project\models;

use Yii;
use app\modules\cubicProject\models\Project;
use app\modules\cubicProject\models\TaskComment;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%cprj_tasks}}".
 *
 * @property integer $id
 * @property integer $projectID
 * @property string $name
 * @property integer $status
 * @property integer $priority
 * @property string $description
 * @property integer $parenttask
 * @property integer $waitListID
 * @property integer $progress
 * @property string $created
 * @property string $startDate
 * @property string $finishDate
 * @property integer $authorID
 * @property integer $responsibleID
 */
class Task extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cprj_tasks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projectID', 'name', 'status', 'priority', 'description', 'parenttask', 'waitListID', 'progress', 'created', 'startDate', 'finishDate', 'authorID', 'responsibleID'], 'required'],
            [['projectID', 'status', 'priority', 'parenttask', 'waitListID', 'progress', 'authorID', 'responsibleID'], 'integer'],
            [['description'], 'string'],
            [['created', 'startDate', 'finishDate'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectID' => 'Project ID',
            'name' => 'Name',
            'status' => 'Status',
            'priority' => 'Priority',
            'description' => 'Description',
            'parenttask' => 'Parent Task',
            'waitListID' => 'Wait List ID',
            'progress' => 'Progress',
            'created' => 'Created',
            'startDate' => 'Start Date',
            'finishDate' => 'Finish Date',
            'authorID' => 'Author ID',
            'responsibleID' => 'Responsible ID',
        ];
    }

    /**
     * @inheritdoc
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }

    public function getProjectName()
    {
        return Project::getProjectName($this->projectID);
    }

    public function getTaskComments()
    {
        $searchModel = new TaskCommentSearch();
        return $searchModel->search(
            ['taskID' => $this->id,]
        );

    }

    public function getChildTasks()
    {
        $query = new Query();
        $query->select(['*'])
            ->from(['cprj_tasks'])
            ->where(['parenttask' => $this->id,])->all();
        return new ActiveDataProvider([
            'query' => $query,
        ]);

    }

    public function getStatusText()
    {
        $query = new Query();
        $query->select(['name'])
            ->from(['cprj_taskstatus'])
            ->where(['id' => $this->status]);
        return $query->one()['name'];


    }

}