<?php

namespace app\models;

use Yii;

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
class Report extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tom_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'name', 'percent_done'], 'required'],
            [['task_id', 'percent_done'], 'integer'],
            [['name'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => TomTask::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'name' => 'Name',
            'percent_done' => 'Percent Done',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(TomTask::className(), ['id' => 'task_id']);
    }
}
