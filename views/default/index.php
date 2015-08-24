<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="project-default-index">
    <h1>Project Summary
    </h1>

    <h2>Choose a Project</h2>
    <div style='width: 80%;'>
<?php
echo  GridView::widget([
        'dataProvider' => $dpProjectList,
////        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'ProjectName',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data['name'], Url::toRoute(['projectview', 'id' => $data['id'],]));
//                    return Html::a($data['name'], Url::toRoute(['view', 'id' => $data['id'],]));

                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
  ]);
?>
        </div>

<!--    <h2>My Projects</h2>-->
    <div style='width: 80%;'>
        <?php

//        echo GridView::widget([
//            'dataProvider' => $dpProjectList,
//        ]);
        ?>
    </div>

<!--    <h2>My Tasks</h2>-->
    <div style='width: 80%;'>
        <?php
//
//        echo GridView::widget([
//            'dataProvider' => $dpTaskList,
//        ]);
        ?>
    </div>

</div>

</div>
