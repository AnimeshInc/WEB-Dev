<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson_plan".
 *
 * @property int $lesson_plan_id
 * @property int $gruppa_id
 * @property int $subject_id
 * @property int $user_id
 *
 * @property Gruppa $gruppa
 * @property Teacher $user
 * @property Subject $subject
 * @property Schedule[] $schedules
 */
class Lesson_plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_plan_id', 'gruppa_id', 'subject_id', 'user_id'], 'required'],
            [['lesson_plan_id', 'gruppa_id', 'subject_id', 'user_id'], 'integer'],
            [['lesson_plan_id'], 'unique'],
            [['gruppa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gruppa::className(), 'targetAttribute' => ['gruppa_id' => 'gruppa_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_plan_id' => 'Lesson Plan ID',
            'gruppa_id' => 'Gruppa ID',
            'subject_id' => 'Subject ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Gruppa]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\GruppaQuery
     */
    public function getGruppa()
    {
        return $this->hasOne(Gruppa::className(), ['gruppa_id' => 'gruppa_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\TeacherQuery
     */
    public function getUser()
    {
        return $this->hasOne(Teacher::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\SubjectQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\ScheduleQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['lesson_plan_id' => 'lesson_plan_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\Lesson_planQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\Lesson_planQuery(get_called_class());
    }
}
