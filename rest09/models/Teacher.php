<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $user_id
 * @property int $otdel_id
 *
 * @property LessonPlan[] $lessonPlans
 * @property Otdel $otdel
 * @property User $user
 * @property Student[] $users
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'otdel_id'], 'required'],
            [['user_id', 'otdel_id'], 'integer'],
            [['user_id'], 'unique'],
            [['otdel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Otdel::className(), 'targetAttribute' => ['otdel_id' => 'otdel_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'otdel_id' => 'Otdel ID',
        ];
    }

    /**
     * Gets query for [[LessonPlans]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\LessonPlanQuery
     */
    public function getLessonPlans()
    {
        return $this->hasMany(LessonPlan::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Otdel]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\OtdelQuery
     */
    public function getOtdel()
    {
        return $this->hasOne(Otdel::className(), ['otdel_id' => 'otdel_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\StudentQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Student::className(), ['user_id' => 'user_id'])->viaTable('user', ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\ScheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ScheduleQuery(get_called_class());
    }
}