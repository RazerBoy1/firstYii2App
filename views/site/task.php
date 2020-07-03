<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Task;

$tasksDataProvider = new ActiveDataProvider([
    'query' => Task::find(),
    /*'pagination' => [
        'pageSize' => 2,
    ],*/
]);

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo GridView::widget([
        'dataProvider' => $tasksDataProvider,
        'columns' => [
            'id',
            'name',
            'start_date',
            'end_date',
            'project_id'
        ],
    ]);
   ?>
</div>
