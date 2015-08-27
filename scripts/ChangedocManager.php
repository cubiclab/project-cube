<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 26.08.2015
 * Time: 14:12
 */
namespace cubiclab\project\scripts;

use Yii;
use yii\db\Connection;
use yii\di\Instance;

class ChangedocManager
{

    const EVT_INSERT = 0;
    const EVT_UPDATE = 1;
    const EVT_DELETE = 2;
    const EVT_UPDATE_PK = 3;

    public static $tableName = '{{%changedocs}}';

    public static $db = 'db';

    public $updatedFields;

    public function setOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $optionKey => $optionValue)
                $this->{$optionKey} = $optionValue;
        }
        return $this;
    }

    public function setUpdatedFields($attributes)
    {
        $this->updatedFields = $attributes;
        return $this;
    }

    /**
     * @param integer $type
     * @param \yii\db\ActiveRecord $object
     */
    public function run($type, $object)
    {
        $pkey = $object->primaryKey();
        $pkey = $pkey[0];
        $data = [
            'table' => $object->tableName(true),
            'model_id' => $object->getPrimaryKey(),
            'type' => $type,
            'date' => date('Y-m-d H:i:s', time()),
        ];
        switch ($type) {
            case self::EVT_INSERT:
                $data['field_name'] = $pkey;
                $this->saveField($data);
                break;
            case self::EVT_UPDATE:
                foreach ($this->updatedFields as $updatedFieldKey => $updatedFieldValue) {
                    $data['field_name'] = $updatedFieldKey;
                    $data['old_value'] = $updatedFieldValue;
                    $data['new_value'] = $object->$updatedFieldKey;
                    $this->saveField($data);
                }
                break;
            case self::EVT_DELETE:
                $data['field_name'] = $pkey;
                $this->saveField($data);
                break;
            case self::EVT_UPDATE_PK:
                $data['field_name'] = $pkey;
                $data['old_value'] = $object->getOldPrimaryKey();
                $data['new_value'] = $object->{$pkey};
                $this->saveField($data);
                break;
        }
    }

    public function saveField($data)
    {
        if ($data['old_value'] == $data['new_value']) {return false; }
        $table = isset($this->tableName) ? $this->tableName : $this::$tableName;
        self::getDB()->createCommand()
            ->insert($table, $data)->execute();
    }

    /**
     * @return object Return database connection
     * @throws \yii\base\InvalidConfigException
     */
    private static function getDB()
    {
        return Instance::ensure(self::$db, Connection::className());
    }
}