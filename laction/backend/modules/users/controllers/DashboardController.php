<?php
namespace app\modules\users\controllers;

use yii\web\Controller;
use Yii;
use backend\controllers\GoController;

class DashboardController extends GoController
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionDashboard()
    {
        echo 'hhh'; die();
        $strView = null;
        $objSession = Yii::$app->session;
        $arrUser = $objSession['session_data'];
        switch ($arrUser['role_name']) {
            case 'admin':
                $this->admin($arrUser);
                break;
            default:
                $strView = '/dashboard/Superadmin';
        }
        return $this->render($strView, []);
    }
}
