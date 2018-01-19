<?php
namespace app\modules\notifications\controllers;

use yii\web\Controller;
use Yii;
use common\components\CommonComponent;
use backend\modules\notifications\models\SenderIds;
use backend\modules\notifications\models\Template;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class NotificationController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionCreateSenderId()
    {
        $arrResponse = [];
        $arrMessageTypes = CommonComponent::getMessageTypes();
        $arrMessageCategoryTypes = CommonComponent::getMessageCategoryTypes();
        $arrInputs = Yii::$app->request->post();
        $arrResponse = isset($arrInputs['create_sender_id']) ? $this->saveSenderId($arrInputs) : [];
        isset($arrResponse['sender_id']) ? Yii::$app->session->setFlash('subject_success', 'Subject created Successfully.') : NULL;
        return $this->render('/SenderId', [
            'message_types' => $arrMessageTypes,
            'category_types' => $arrMessageCategoryTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : [],
            'fields' => isset($arrResponse['fields']) ? $arrResponse['fields'] : []
        ]);
    }

    private function saveSenderId($arrInputs)
    {
        $arrResponse = [];
        $arrRoutes = CommonComponent::getRoutes();
        $arrInputs['route'] = isset($arrRoutes[$arrInputs['message_type']][$arrInputs['category_type']]) ? $arrRoutes[$arrInputs['message_type']][$arrInputs['category_type']] : NULL;
        $objSenderId = new SenderIds();
        $arrDefaults = $objSenderId->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objSenderId->attributes = $arrInputs;
        if ($objSenderId->validate()) {
            $objSenderId->save();
            $arrResponse['sender_id'] = $objSenderId->id;
        } else {
            $arrResponse['errors'] = $objSenderId->errors;
            $arrResponse['fields'] = $objSenderId->getAttributes();
        }
        unset($arrInputs, $arrDefaults);
        return $arrResponse;
    }

    public function actionCreateTemplate()
    {
        $arrResponse = [];
        $arrMessageTypes = CommonComponent::getMessageTypes();
        $arrInputs = Yii::$app->request->post();
        $arrResponse = ! empty($arrInputs) ? $this->saveTemplate($arrInputs) : [];
        isset($arrResponse['template_id']) ? Yii::$app->session->setFlash('template_success', 'Template created Successfully.') : NULL;
        return $this->render('/Template', [
            'message_types' => $arrMessageTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : [],
            'fields' => isset($arrResponse['fields']) ? $arrResponse['fields'] : []
        ]);
    }

    private function saveTemplate($arrInputs)
    {
        $arrResponse = [];
        $objTemplate = new Template();
        $arrDefaults = $objTemplate->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objTemplate->attributes = $arrInputs;
        if ($objTemplate->validate()) {
            $objTemplate->save();
            $arrResponse['template_id'] = $objTemplate->id;
        } else {
            $arrResponse['errors'] = $objTemplate->errors;
            $arrResponse['fields'] = $objTemplate->getAttributes();
        }
        unset($arrInputs, $arrDefaults);
        return $arrResponse;
    }

    public function actionEditSenderId()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->get();
        $arrMessageTypes = CommonComponent::getMessageTypes();
        $arrMessageCategoryTypes = CommonComponent::getMessageCategoryTypes();
        $arrRoutes = CommonComponent::getRoutes();
        $arrSenderId = SenderIds::getSenderIds([
            'sender_id' => $arrInputs['id']
        ]);
        if (Yii::$app->request->isPost) {
            $arrFields = Yii::$app->request->post();
            $arrResponse = $this->saveSenderId($arrFields);
        }
        return $this->render('/SenderId', [
            'message_types' => $arrMessageTypes,
            'category_types' => $arrMessageCategoryTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    public function getSubjects()
    {
        $strResponse = NULL;
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {}
        
        echo $strResponse;
    }
}
