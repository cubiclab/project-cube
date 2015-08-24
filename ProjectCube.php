<?php
namespace cubiclab\project;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * @version 0.0.1-prealpha
 */
class ProjectCube extends \yii\base\Module //implements BootstrapInterface
{

    /** @const VERSION Module version */
    const VERSION = "0.0.1-prealpha";

  //  public function bootstrap($app){
        // Add module URL rules.
//        $rules = require(__DIR__ . '/config/urlRules.php');
//        $app->urlManager->addRules( $rules, false );
  //  }

    public function init()
    {

        parent::init();

        // custom initialization code goes here
    }

}