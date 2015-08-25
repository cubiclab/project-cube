<?php
namespace cubiclab\project;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use cubiclab\project\scripts\BreadcrumbTraceInterface;

/**
 * @version 0.0.1-prealpha
 */
class ProjectCube extends \yii\base\Module //implements BreadcrumbTraceInterface
{

    /** @const VERSION Module version */
    const VERSION = "0.0.1-prealpha";


//************************************************//
//    BreadcrumbTraceInterface
//************************************************//


    public function bct_getParent()
    {
        return null;
    }

    public function bct_getBreadcrumb()
    {
        return ['label' => 'project-cube', 'url' => ['default/index',]];
    }


    public function init()
    {

        parent::init();

        // custom initialization code goes here
    }

}