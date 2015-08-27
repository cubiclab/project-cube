<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\CprjTaskstatus */

$this->title = 'Update Cprj Taskstatus: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cprj Taskstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cprj-taskstatus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
