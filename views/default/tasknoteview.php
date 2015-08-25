<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use cubiclab\project\scripts\BreadcrumbTraceHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\TaskComment */

$this->title = 'Note #'.$model->id;
BreadcrumbTraceHelper::bct_getBreadcrumbTrace($model, $trace);
$this->params['breadcrumbs'] = $trace;
?>
<div class="task-comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['tasknoteupdate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['tasknotedelete', 'id' => $model->id, 'taskid'=>$model->taskID,], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'taskID',
            'message:ntext',
            'userID',
            'postedTime',
        ],
    ]) ?>


</div>
