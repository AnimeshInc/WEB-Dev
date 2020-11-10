<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Schedule;
use Yii;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;
use yii\web\NotFoundHttpException;

class ScheduleController extends BaseController
{

    public function actionIndex()
    {
        return new ActiveDataProvider(['query' => Schedule::find()]);
    }

    public function actionCreate()
    {
        $schedule = new Schedule();
        return $this->saveModel($schedule);
    }

    public function actionUpdate($id)
    {
        $schedule = $this->findModel($id);
        return $this->saveModel($schedule);
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function saveModel($schedule)
    {
        if ($schedule->loadAndSave(Yii::$app->getRequest()->getBodyParams())) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $response->getHeaders()->set('Location',
            Url::toRoute(['view', 'id' => $schedule->getPrimaryKey()], true));
        } 
        elseif (!$schedule->hasErrors()) {
            throw new
            ServerErrorHttpException(serialize($schedule->getErrors()));
        }  
        return $schedule;
    }
    public function findModel($id)
    {
        $schedule = Schedule::findOne($id);
        if ($schedule === null) {
            throw new NotFoundHttpException("Schedule with ID $id not found");
        }
        return $schedule;
    }

}