<?php
namespace app\modules\notifications\controllers;

use yii\web\Controller;
use Yii;
use common\components\CommonComponent;
use backend\modules\notifications\models\SenderIds;
use backend\modules\notifications\models\Template;

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
        $arrRoutes = CommonComponent::getRoutes();
        $arrInputs = Yii::$app->request->post();
        if (isset($arrInputs['create_sender_id'])) {
            $arrInputs['route'] = isset($arrRoutes[$arrInputs['message_type']][$arrInputs['category_type']]) ? $arrRoutes[$arrInputs['message_type']][$arrInputs['category_type']] : NULL;
            $arrResponse = ! empty($arrInputs) ? $this->saveSenderId($arrInputs) : [];
        }
        return $this->render('/SenderId', [
            'message_types' => $arrMessageTypes,
            'category_types' => $arrMessageCategoryTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    private function saveSenderId($arrInputs)
    {
        $arrResponse = [];
        $objSenderId = new SenderIds();
        $arrDefaults = $objSenderId->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objSenderId->attributes = $arrInputs;
        if ($objSenderId->validate()) {
            $objSenderId->save();
            $arrResponse['sender_id'] = $objSenderId->id;
        } else {
            $arrResponse['errors'] = $objSenderId->errors;
        }
        unset($arrInputs, $arrDefaults);
        return $arrResponse;
    }

    public function actionCreateTemplate()
    {
        $arrResponse = [];
        $arrMessageTypes = CommonComponent::getMessageTypes();
        $arrInputs = Yii::$app->request->post();
        $arrInputs = [
            'message_type' => 'sms',
            'from_email' => 'info@lactionstudio.com',
            'senderid_id' => 1,
            'code' => 'NEWRG',
            'name' => 'User Registration',
            'template' => '<div><p>abc</p></div>',
            'description' => 'Hi Hello Please check it.',
            'status' => 'active'
        ];
        $arrResponse = ! empty($arrInputs) ? $this->saveTemplate($arrInputs) : [];
        print_r($arrResponse);
        die();
        return $this->render('/Template', [
            'message_types' => $arrMessageTypes,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
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
}
