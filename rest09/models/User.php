<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $lastname
 * @property string|null $firstname
 * @property string|null $patronymic
 * @property string|null $login
 * @property string|null $pass
 * @property int $gender_id
 * @property string|null $birthday
 * @property int $role_id
 * @property int $active
 *
 * @property Student $user
 * @property Teacher $user0
 * @property Role $role
 * @property Gender $gender
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lastname', 'gender_id', 'role_id'], 'required'],
            [['user_id', 'gender_id', 'role_id', 'active'], 'integer'],
            [['birthday'], 'safe'],
            [['lastname', 'firstname', 'patronymic', 'login'], 'string', 'max' => 50],
            [['pass'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'role_id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'gender_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'pass' => 'Pass',
            'gender_id' => 'Gender ID',
            'birthday' => 'Birthday',
            'role_id' => 'Role ID',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\StudentQuery
     */
    public function getUser()
    {
        return $this->hasOne(Student::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\TeacherQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Teacher::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\RoleQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\GenderQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['gender_id' => 'gender_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\UserQuery(get_called_class());
    }
}