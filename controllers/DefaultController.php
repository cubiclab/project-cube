<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 24.08.2015
 * Time: 14:28
 */

namespace cubiclab\project\controllers;

use Yii;
use cubiclab\project\models\Project;
use cubiclab\project\models\ProjectSearch;
use cubiclab\project\models\Task;
use cubiclab\project\models\TaskQuery;
use cubiclab\project\models\TaskSearch;
use cubiclab\project\models\TaskStatus;
use cubiclab\project\models\TaskStatusSearch;
use cubiclab\project\models\TaskComment;
use cubiclab\project\models\TaskCommentSearch;

use yii\web\Session;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\url;
use yii\data\ActiveDataProvider;


/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchProject = new ProjectSearch();
        $dpProjectList = $searchProject->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dpProjectList' => $dpProjectList,
        ]);

    }

    public function actionProjectview()
    {
$id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            $this->redirect(['index']);
        }

//        $this->setCurrentProject($projectid);
        return $this->render('projectview', [
            'model' => $this->findProjectmodel($id),
        ]);
    }

    protected function findProjectmodel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            return new NotFoundHttpException('The requested project does not exist.');

        }

    }


}