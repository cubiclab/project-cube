<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Project', 'url' => ['projectview', 'id' => $model->projectID,]];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['tasklist', 'projectid' => $model->projectID,]];
$this->params['breadcrumbs'][] = $this->title;
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
    <?= Html::a('Note List', ['tasknotelist', 'taskid' => $model->id, ], ['class' => 'btn btn-primary']) ?>
    </div>


    <?php
    foreach ($model->TaskNotes() as $tasknote) {
        $message = substr($tasknote->message, 0, 26);
        $message = str_replace(['\r\n', '\n', '\r',],'',$message) . '...';

        echo Html::a(Html::encode($message), ['tasknoteview', 'id' => $tasknote->id,]);
        echo Html::tag('br');

    }

    //    ListView::widget([
    //        'dataProvider' => $model->getTaskComments(),
    //        'itemView' =>
    //            function ($comment) {
    //                echo '<tr><td>' .
    //                    $comment->id .
    //                    '</td><td>' .
    //                    Html::a($comment->message, ['project/tasknoteview', 'id' => $comment->id]) .
    //                    '</td><td>' .
    //                    $comment->userID .
    //                    '</td><td>' .
    //                    $comment->postedTime .
    //                    '</td></tr><br>';
    //            }
    //    ]);
    ?>
    <?= Html::a('Add comment', ['tasknotecreate', 'projectid' => $model->projectID, 'taskid' => $model->id,]) ?>


    <h2>Subtasks</h2>
    <?php
    //    ListView::widget(['dataProvider' => $model->getChildTasks(),
    //        'itemView' =>
    //            function ($child) {
    //                echo Html::a($child['name'], ['project/taskview', 'id' => $child['id'], 'projectid' => $child['projectID']]);
    //                echo Html::tag('br');
    //            }]);
    ?>
    <?= Html::a('Add subtask', ['taskcreate', 'projectid' => $model->projectID, 'parenttask' => $model->id,]) ?>


</div>
