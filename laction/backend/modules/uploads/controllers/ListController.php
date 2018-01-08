<?php
namespace app\modules\uploads\controllers;

use yii\web\Controller;
use moonland\phpexcel\Excel;
use Yii;
use yii\helpers\ArrayHelper;

class ListController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLocations()
    {
        $arrStates = $this->getData('States');
        return $this->render('/List/Locations', [
            'states' => $arrStates
        ]);
    }

    private function getData($strModel)
    {
        $strModel = '\\backend\\models\\' . $strModel;
        $objModel = new $strModel();
        $objModel = $objModel->find();
        // Add where condition if need
        // For example do filter for streams like get only seconeary education streams
        $objModel = $objModel->asArray();
        $arrResult = $objModel->all();
        unset($strModel);
        return $arrResult;
    }
}
