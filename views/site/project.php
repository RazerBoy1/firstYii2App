<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Progress;
use app\models\Project;

$query = Project::find()
    ->select('tp.*, AVG(tr.percent_done) AS percent_done')
    ->from('tom_project AS tp')
    ->join('LEFT JOIN', 'tom_task AS tt', 'tt.project_id = tp.id')
    ->join('LEFT JOIN', 'tom_report AS tr', 'tr.task_id = tt.id')
    ->groupBy('tp.id');

$projectsDataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 3,
    ],
]);

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo GridView::widget([
        'dataProvider' => $projectsDataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'percent_done',
                'format' => 'raw',
                'value' => static function ($data) {
                    return Progress::widget(
                        [
                            'percent' => (float)$data->percent_done,
                            'options' => ['class' => 'progress-success'],
                        ]
                    );
                }
            ],
        ],
    ]);
    ?>
</div>
