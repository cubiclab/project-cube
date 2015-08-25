<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 24.08.2015
 * Time: 14:28
 */

namespace cubiclab\project\controllers;

use cubiclab\project\models\TaskNote;
use Yii;
use cubiclab\project\models\Project;
use cubiclab\project\models\ProjectSearch;
use cubiclab\project\models\Task;

//use cubiclab\project\models\TaskQuery;
//use cubiclab\project\models\TaskSearch;
//use cubiclab\project\models\TaskStatus;
//use cubiclab\project\models\TaskStatusSearch;
//use cubiclab\project\models\TaskComment;
//use cubiclab\project\models\TaskCommentSearch;

use yii\db\ActiveQuery;
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

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionProjectcreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['projectview', 'id' => $model->id]);
        } else {
            return $this->render('projectcreate', [
                'model' => $model,
            ]);
        }
    }

    public function actionProjectview()
    {
        $id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            $this->redirect(['index']);
        }

        $model = $this->findProjectmodel($id);
        if (!isset($model) || !$model instanceof Project) {
            throw new NotFoundHttpException('The requested project does not exist.');
        }


        return $this->render('projectview', ['model' => $model,]);
    }

    protected function findProjectmodel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested project does not exist.');

        }

    }


    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionProjectupdate()
    {
        $id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            return new NotFoundHttpException('The requested project does not exist.');
        }

        $model = $this->findProjectmodel($id);
        if (!$model instanceof Project) {
            return false;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['projectview', 'id' => $model->id]);
        } else {
            return $this->render('projectupdate', [
                'model' => $model,
            ]);
        }
    }

    private
    function getRequestParam($paramname)
    {
        $param = \Yii::$app->request->get($paramname);
        if (!isset($param)) {
            throw new NotFoundHttpException('The requested parameter "' . $paramname . '" not found in request.');
        } else {
            return $param;
        }
    }

    public
    function actionProjectdelete()
    {
        $id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            return new NotFoundHttpException('The requested project does not exist.');
        }
        $model = $this->findProjectmodel($id);
        if ($model instanceof Project) {
            $model->delete();
            return $this->redirect(['index']);
        }
    }

//************************************************************//
//            Tasks CRUD                                      //
//************************************************************//

    public function actionTasklist()
    {
        $projectID = $this->getRequestParam('projectid');

        $project = new Project();
        $tasks = $project->getTasks($projectID);

        return $this->render('tasklist', [
            'projectid' => $projectID,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTaskcreate()
    {
        $projectid = $this->getRequestParam('projectid');

        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::toRoute(['taskview', 'projectid' => $projectid, 'id' => $model->id,]));
        } else {
            $model->projectID = $projectid;
            return $this->render('taskcreate', [
                'model' => $model,]);
        }
    }

    /**
     * Displays a single Task model.
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTaskview()
    {
        $id = $this->getRequestParam('id');
        $model = Project::getTaskModel($id);

        if (!isset($model)) {
            throw new NotFoundHttpException('The Task "' . $id . '" not found.');
        }

        return $this->render('taskview', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTaskUpdate($id)
    {
        $model = Project::getTaskModel($id);
        if (!isset($model)) {
            throw new NotFoundHttpException('The Task "' . $id . '" not found.');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['taskview', 'id' => $model->id,]);
        } else {
            return $this->render('taskupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTaskdelete($id)
    {

        $task = Project::getTaskModel($id);
        $projectid = $task->projectID;
        $task->delete();

        return $this->redirect(['tasklist', 'projectid' => $projectid]);
    }


//****************************************************************//
//    Task note CRUD
//****************************************************************//
    public function actionTasknotelist($taskid = null)
    {
        if (!isset($taskid)) {
            return false;
        }
        $tasknotes = Task::getTaskNotes($taskid);
        return $this->render('tasknotelist', [
            'tasknotes' => $tasknotes,
        ]);

        /*//        $searchModel = new TaskCommentSearch();
        //        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tasknotes = Task::getTaskNotes($this->id);
            }*/
    }

    /**
     * Creates a new TaskNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionTasknotecreate($projectid, $taskid)
    {
        $model = new TaskNote();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::toRoute(['tasknoteview', 'projectid' => $projectid, 'taskid' => $taskid, 'id' => $model->id,]));
        } else {
            $model->taskID = $taskid;
            return $this->render('tasknotecreate', [
                'model' => $model,]);
        }
    }

    /**
     * Displays a single TaskComment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTasknoteview($id)
    {

        $model = Task::getTaskNoteModel($id);

        if (!isset($model)) {
            throw new NotFoundHttpException('The Task "' . $id . '" not found.');
        }

        return $this->render('tasknoteview', [
            'model' => Task::getTaskNoteModel($id),
        ]);

    }

    /**
     * Updates an existing TaskComment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTasknoteupdate($id)
    {
        $model = Task::getTaskNoteModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['tasknoteview', 'id' => $model->id]);
        } else {
            return $this->render('tasknoteupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTasknotedelete($taskid, $id)
    {
        Task::getTaskNoteModel($id)->delete();

        return $this->redirect(['tasknotelist', 'taskid' => $taskid]);
    }
}
