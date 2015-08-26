<?php

use yii\helpers\Html;
use cubiclab\project\scripts\BreadcrumbTraceHelper;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Tasks */

$this->title = $model->name;
BreadcrumbTraceHelper::bct_getBreadcrumbTrace($model, $trace);
$this->params['breadcrumbs'] = $trace;
$this->params['breadcrumbs_homeLink'] = ['label'=>'project-cube', 'url'=>['default/index',]];

?>
<div class="tasks-view">
    <div>
        <div>
            <h1> #<?= Html::encode($model->id) ?> <?= Html::encode($this->title) ?></h1>
        </div>
        <div>
            <?= Html::a('Update', ['task-update', 'id' => $model->id, 'projectid' => $model->projectID,], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['taskdelete', 'id' => $model->id,], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

        </div>
    </div>
    <div class='task_head'>

        <table>
            <tr>
                <td>Создана:</td>
                <td><?= Html::encode($model->created) ?></td>
            </tr>
            <tr>
                <td>Статус:</td>
                <td><?= Html::encode($model->getStatusText()) ?></td>
            </tr>
            <tr>
                <td>Приоритет:</td>
                <td><?= Html::encode($model->priority) ?> </td>
            </tr>
            <tr>
                <td>Назначена:</td>
                <td><?= Html::encode($model->responsibleID) ?></td>
            </tr>
        </table>
    </div>

    <div>
        <?= Html::encode($model->description) ?>
    </div>

    <h1>Task Notes:</h1>
    <div>
    <?php //Html::a('Note List', ['tasknotelist', 'taskid' => $model->id, ], ,) ?>
    </div>


    <?php
    foreach ($model->TaskNotes() as $tasknote) {
        $message = substr($tasknote->message, 0, 26);
        $message = str_replace(['\r\n', '\n', '\r',],'',$message) . '...';

        echo Html::a(Html::encode($message), ['tasknoteview', 'id' => $tasknote->id,]);
        echo Html::tag('br');

    }

     ?>
    <?= Html::a('Add comment', ['tasknotecreate', 'projectid' => $model->projectID, 'taskid' => $model->id,], ['class' => 'btn btn-primary']) ?>


    <h2>Subtasks</h2>
    <?php

    foreach ($model->getSubtasks() as $subtask) {

        echo Html::a($subtask->name, Url::toRoute(['taskview', 'id'=>$subtask->id,]));
        echo Html::tag('br');
    }

    ?>
    <?= Html::a('Add subtask', ['taskcreate', 'projectid' => $model->projectID, 'parenttask' => $model->id,], ['class' => 'btn btn-primary']) ?>


</div>
