<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Lesson_plan]].
 *
 * @see \app\models\Lesson_plan
 */
class Lesson_planQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Lesson_plan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Lesson_plan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
