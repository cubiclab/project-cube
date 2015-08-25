<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\TaskComment */

$this->title = 'Update Task Comment: ' . ' ' . $model->id;
/*$this->params['breadcrumbs'][] = ['label' => 'Task Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="task-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_tasknoteform', [
        'model' => $model,
    ]) ?>

</div>
