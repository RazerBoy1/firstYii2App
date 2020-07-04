<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
class Task extends ActiveRecord
{
    public $percent_done;

    public static function tableName()
    {
        return 'tom_task';
    }

    public function rules()
    {
        return [
            [['project_id', 'name'], 'required'],
            [['project_id'], 'integer'],
            [['name', 'percent_done'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => TomProject::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'name' => Yii::t('app', 'Name'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'percent_done' => Yii::t('app', 'Percent Done'),
        ];
    }

    public function getTomReports()
    {
        return $this->hasMany(TomReport::className(), ['task_id' => 'id']);
    }

    public function getProject()
    {
        return $this->hasOne(TomProject::className(), ['id' => 'project_id']);
    }
}
