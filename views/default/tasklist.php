<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cubicProject\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Project', 'url' => ['projectview', 'id' => $projectid,]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
      foreach ($tasks as $task) {
        echo Html::a($task->name, Url::toRoute(['taskview', 'id'=>$task->id,]));
          echo Html::tag('br');
      }
    ?>
    <p>
        <?= Html::a('Create Tasks', Url::toRoute(['taskcreate', 'projectid'=>$projectid,]), ['class' => 'btn btn-success']) ?>
    </p>


</div>
