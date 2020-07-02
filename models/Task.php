<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tom_task".
 *
 * @property int $id
 * @property int $project_id
 * @property string $name
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property TomReport[] $tomReports
 * @property TomProject $project
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tom_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'name'], 'required'],
            [['project_id'], 'integer'],
            [['name'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TomProject::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[TomReports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTomReports()
    {
        return $this->hasMany(TomReport::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(TomProject::className(), ['id' => 'project_id']);
    }
}
