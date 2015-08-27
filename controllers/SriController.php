<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 27.08.2015
 * Time: 16:08
 */
namespace cubiclab\project\controllers;

use Yii;
use cubiclab\project\models\SRI_Taskstatus;
use cubiclab\project\models\SRITaskstatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskstatusController implements the CRUD actions for CprjTaskstatus model.
 */
class SriController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SRITaskstatus models.
     * @return mixed
     */
    public function actionTaskstatusindex()
    {
        $searchModel = new SRITaskstatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('taskstatus_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SRITaskstatus model.
     * @param integer $id
     * @return mixed
     */
    public function actionTaskstatusview($id)
    {
        return $this->render('taskstatus_view', [
            'model' => $this->findTaskstatusmodel($id),
        ]);
    }

    /**
     * Creates a new SRITaskstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTaskstatuscreate()
    {
        $model = new SRI_Taskstatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['taskstatusview', 'id' => $model->id]);
        } else {
            return $this->render('taskstatus_create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SRITaskstatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTaskstatusupdate($id)
    {
        $model = $this->findTaskstatusmodel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['taskstatusview', 'id' => $model->id]);
        } else {
            return $this->render('taskstatus_update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SRITaskstatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTaskstatusdelete($id)
    {
        $this->findTaskstatusmodel($id)->delete();

        return $this->redirect(['taskstatusindex']);
    }

    /**
     * Finds the SRITaskstatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SRITaskstatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTaskstatusmodel($id)
    {
        if (($model = SRI_Taskstatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
