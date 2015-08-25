<?php

/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 25.08.2015
 * Time: 18:01
 */
namespace cubiclab\project\scripts;

//use  cubiclab\project\common\BreadcrumbTraceInterface;
use cubiclab\project\models\Project;

class BreadcrumbTraceHelper
{
    public static function bct_getBreadcrumbTrace($model, &$trace)
    {
        if (!$model instanceof BreadcrumbTraceInterface) {
            return null;
        }

        if (!isset($trace)) {
            $trace = array();
        }

        $currModel = $model;


        $parent = $currModel->bct_getParent();
        if (isset($parent)) {

            self::bct_getBreadcrumbTrace($parent, $trace);
        }

        $trace[] = $model->bct_getBreadcrumb();

    }
}