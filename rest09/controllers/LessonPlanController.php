<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\LessonPlan;
use Yii;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;
use yii\web\NotFoundHttpException;

class LessonPlanController extends BaseController
{

    public function actionIndex()
    {
        return new ActiveDataProvider(['query' => LessonPlan::find()]);
    }

    public function actionCreate()
    {
        $lessonplan = new LessonPlan();
        return $this->saveModel($lessonplan);
    }

    public function actionUpdate($id)
    {
        $lessonplan = $this->findModel($id);
        return $this->saveModel($lessonplan);
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function saveModel($lessonplan)
    {
        if ($lessonplan->loadAndSave(Yii::$app->getRequest()->getBodyParams())) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $response->getHeaders()->set('Location',
            Url::toRoute(['view', 'id' => $lessonplan->getPrimaryKey()], true));
        } 
        elseif (!$lessonplan->hasErrors()) {
            throw new
            ServerErrorHttpException(serialize($lessonplan->getErrors()));
        }  
        return $lessonplan;
    }
    public function findModel($id)
    {
        $lessonplan = LessonPlan::findOne($id);
        if ($lessonplan === null) {
            throw new NotFoundHttpException("Lesson Plan with ID $id not found");
        }
        return $lessonplan;
    }
    
}
