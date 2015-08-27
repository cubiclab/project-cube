<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use cubiclab\project\scripts\BreadcrumbTraceHelper;
use \cubiclab\admin\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Projects */

$this->title = $model->name;
BreadcrumbTraceHelper::bct_getBreadcrumbTrace($model, $trace);
$this->params['breadcrumbs'] = $trace;

//$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['projectview', 'id'=>$model->id, ]];
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php
Panel::begin(
    [
        'title' => $this->title,
'headStyle' => Panel::WARNING,
'fullColor' => true,
//'buttonsTemplate' => $boxButtons,
    ]
);
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['projectupdate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['projectdelete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?= Html::encode($model->description) ?>
    <div>
        <?= Html::encode('Status') ?> <?= Html::encode($model->getStatusText($model->status)) ?>

        <?= Html::encode('Created') ?> <?= Html::encode($model->created) ?>
    </div>

    <!--<div class="project-tasklist">-->
        <h1>Task list</h1>
        <?php
        foreach ($model->getTasks() as $task) {
            echo Html::a($task->name, $task->bct_getBreadcrumb()['url']);
            echo Html::tag('br');
        }

        ?>
        <?= Html::a('TaskList', ['tasklist', 'projectid' => $model->id], ['class' => 'btn btn-primary']) ?>
   <!-- </div>-->


    </div>

<?php \cubiclab\admin\widgets\Panel::end(); ?>