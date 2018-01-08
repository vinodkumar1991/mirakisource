<?php
namespace app\modules\dashboard\controllers;

use yii\web\Controller;

class DashboardController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionDashboard()
    {
        return $this->render('/Dashboard', []);
    }
}
