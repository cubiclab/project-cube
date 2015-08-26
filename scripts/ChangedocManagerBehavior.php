<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 26.08.2015
 * Time: 15:41
 */
namespace cubiclab\project\scripts;
use cubiclab\project\scripts\ChangedocManager;
use yii\db\BaseActiveRecord;
use \yii\base\Behavior;

class ChangedocManagerBehavior extends Behavior
{
    /**
     * @var BaseManager
     */
    public $manager ='cubiclab\project\scripts\ChangedocManager';
    /**
     * @var array
     */
    public $managerOptions;
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'saveHistory',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'saveHistory',
        ];
    }

    public function saveHistory($event){
        $manager = new $this->manager;
        $manager->setOptions($this->managerOptions);
        switch ($event->name){
            case BaseActiveRecord::EVENT_AFTER_INSERT:
                $type = $manager::EVT_INSERT;
                $manager->setUpdatedFields($event->changedAttributes);
                break;
            case BaseActiveRecord::EVENT_AFTER_UPDATE:
                $type = $this->owner->getOldPrimaryKey() != $this->owner->getPrimaryKey()
                    ? $manager::EVT_UPDATE_PK
                    : $manager::EVT_UPDATE;
                $manager->setUpdatedFields($event->changedAttributes);
                break;
            case BaseActiveRecord::EVENT_AFTER_DELETE:
                $type = $manager::EVT_DELETE;
                break;
            default:
                throw new \Exception('Not found event!');
        }
        $manager->run($type, $this->owner);
    }
}