<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cubicProject\models\TaskCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Note', ['tasknotecreate', 'projectid' => $task->projectID, 'taskid' => $task->id,], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    foreach ($tasknotes as $tasknote) {
        echo Html::a($tasknote->message, ['tasknoteview', 'id' => $tasknote->id,]);
    }
    ?>
</div>
