<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;
use app\models\Report;

$reportsDataProvider = new ActiveDataProvider([
    'query' => Report::find(),
    'pagination' => [
        'pageSize' => 2,
    ],
]);

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo GridView::widget([
        'dataProvider' => $reportsDataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'percent_done',
                'format' => 'raw',
                'value' => function($data) {
                    return Progress::widget(
                        [
                            'percent' => $data->percent_done,
                            'options' => ['class' => 'progress-success'],
                        ]
                    );
                }
            ],
            'task_id'
        ],
    ]);
   ?>
</div>
