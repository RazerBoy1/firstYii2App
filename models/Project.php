<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tom_project".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property TomTask[] $tomTasks
 */
class Project extends ActiveRecord
{
    public $percent_done;

    public static function tableName()
    {
        return 'tom_project';
    }

    public function rules()
    {
        return [
            [['name', 'percent_done'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'percent_done' => Yii::t('app', 'Percent Done'),
        ];
    }

    public function getTomTasks()
    {
        return $this->hasMany(TomTask::className(), ['project_id' => 'id']);
    }
}
