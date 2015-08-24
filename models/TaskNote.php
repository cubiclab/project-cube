<?php

namespace cubiclab\project\models;

use Yii;

/**
 * This is the model class for table "{{%cprj_taskcomments}}".
 *
 * @property integer $id
 * @property integer $taskID
 * @property string $message
 * @property integer $userID
 * @property string $postedTime
 */
class TaskNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cprj_taskcomments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taskID', 'message', 'userID', 'postedTime'], 'required'],
            [['taskID', 'userID'], 'integer'],
            [['message'], 'string'],
            [['postedTime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taskID' => 'Task ID',
            'message' => 'Message',
            'userID' => 'User ID',
            'postedTime' => 'Posted Time',
        ];
    }

    /**
     * @inheritdoc
     * @return TaskCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskCommentQuery(get_called_class());
    }
}
