<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Progress;
use app\models\Task;

$query = Task::find()
    ->select('tt.*, AVG(tr.percent_done) AS percent_done')
    ->from('tom_task AS tt')
    ->join('LEFT JOIN', 'tom_report AS tr', 'tr.task_id = tt.id')
    ->groupBy('tt.id');

$tasksDataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 3,
    ],
]);

$this->title = Yii::t('app', 'Tasks');
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
            [
                'attribute' => 'percent_done',
                'format' => 'raw',
                'value' => static function ($data) {
                    return Progress::widget(
                        [
                            'percent' => (float)$data['percent_done'],
                            'options' => ['class' => 'progress-success'],
                        ]
                    );
                }
            ],
            'project_id'
        ],
    ]);
    ?>
</div>
