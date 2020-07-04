<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tom_report".
 *
 * @property int $id
 * @property int $task_id
 * @property string $name
 * @property int $percent_done
 *
 * @property TomTask $task
 */
class Report extends ActiveRecord
{
    public static function tableName()
    {
        return 'tom_report';
    }

    public function rules()
    {
        return [
            [['task_id', 'name', 'percent_done'], 'required'],
            [['task_id', 'percent_done'], 'integer'],
            [['name'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => TomTask::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'name' => Yii::t('app', 'Name'),
            'percent_done' => Yii::t('app', 'Percent Done'),
        ];
    }

    public function getTask()
    {
        return $this->hasOne(TomTask::className(), ['id' => 'task_id']);
    }
}
