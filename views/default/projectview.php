<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use cubiclab\project\scripts\BreadcrumbTraceHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Projects */

$this->title = $model->name;
BreadcrumbTraceHelper::bct_getBreadcrumbTrace($model, $trace);
$this->params['breadcrumbs'] = $trace;

//$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['projectview', 'id'=>$model->id, ]];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">
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
    </div>

    <div class="project-tasklist">
        <?= Html::a('TaskList', ['tasklist', 'projectid' => $model->id], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
</div>
