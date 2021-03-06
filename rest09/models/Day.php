<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day".
 *
 * @property int $day_id
 * @property string $name
 *
 * @property Schedule[] $schedules
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day_id', 'name'], 'required'],
            [['day_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['day_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'day_id' => 'Day ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['day_id' => 'day_id']);
    }
}
