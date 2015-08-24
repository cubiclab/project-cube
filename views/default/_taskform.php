<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use cubiclab\project\models\Project;
use cubiclab\project\models\Task;

/* @var $this yii\web\View */
/* @var $model app\modules\cubicProject\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $prjArr = Project::getProjectArr();
    echo $form->field($model, 'projectID')->dropDownList($prjArr) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    //    $stArr = TaskStatus::getTaskStatusArr();
    //    array_unshift($stArr, '');
    //    echo $form->field($model, 'status')->dropDownList($stArr);
    ?>
    <?= $form->field($model, 'status')->textInput(); ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'progress')->textInput() ?>
    <?= $form->field($model, 'created')->textInput() ?>
    <?= $form->field($model, 'authorID')->textInput() ?>
    <?= $form->field($model, 'startDate')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'finishDate')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <?= $form->field($model, 'startDatePlan')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <?= $form->field($model, 'endDatePlan')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'responsibleID')->textInput() ?>
    <?= $form->field($model, 'parenttask')->textInput() ?>
    <?= $form->field($model, 'waitListID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
