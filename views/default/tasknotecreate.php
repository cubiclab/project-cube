<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\TaskComment */

$this->title = 'Create Task Comment';
//$this->params['breadcrumbs'][] = ['label' => 'Task Comments', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_tasknoteform', [
        'model' => $model,
    ]) ?>

</div>
