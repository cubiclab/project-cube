<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Projects */

$this->title = 'Create Projects';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_projectform', [
        'model' => $model,
    ]) ?>

</div>
