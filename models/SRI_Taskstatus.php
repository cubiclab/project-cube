<?php

namespace cubiclab\project\models;

use Yii;

/**
 * This is the model class for table "cprj_taskstatus".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 */
class SRI_Taskstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cprj_taskstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name'], 'string', 'max' => 25],
            [['description'], 'string', 'max' => 120],
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
        ];
    }
}
