<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Project;

$projectsDataProvider = new ActiveDataProvider([
    'query' => Project::find(),
    'pagination' => [
        'pageSize' => 2,
    ],
]);

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo GridView::widget([
        'dataProvider' => $projectsDataProvider,
        'columns' => [
            'id',
            'name'
        ],
    ]);
   ?>
</div>
