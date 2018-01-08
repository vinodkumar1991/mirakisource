<?php
namespace app\modules\users\controllers;

use yii\web\Controller;
use Yii;
use backend\modules\users\models\Roles;
use backend\modules\users\models\Permissions;
use backend\modules\users\models\RolePermissions;
use backend\modules\users\models\Users;
use backend\modules\users\models\Token;
use common\components\CommonComponent;
use yii\helpers\Json;

class UsersController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        return $this->render('/Login', []);
    }

    public function actionDashboard()
    {
        return $this->render('/users/list', []);
    }

    public function actionRolePermissions()
    {
        $arrErrors = $arrResponse = [];
        $arrRoles = Roles::find()->select([
            'id',
            'name'
        ])
            ->asArray()
            ->all();
        $arrPermissions = Permissions::find()->select([
            'id',
            'name'
        ])
            ->asArray()
            ->all();
        $arrInputs = Yii::$app->request->post();
        $arrInputs['role'] = 'superadmin';
        $arrInputs['permission'] = [
            0 => 'slots',
            1 => 'reports',
            2 => 'users',
            3 => 'notifications'
        ];
        $arrInputs['status'] = 'active';
        $arrResponse = ! empty($arrInputs) ? $this->saveRolePermissions($arrInputs) : [];
        print_r($arrResponse);
        die();
        return $this->render('/RolePermission', [
            'roles' => $arrRoles,
            'permissions' => $arrPermissions,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    private function saveRolePermissions($arrInputs)
    {
        $arrResponse = [];
        $objRolePermissions = new RolePermissions();
        $objRolePermissions->attributes = $arrInputs;
        if ($objRolePermissions->validate()) {
            $arrValidatedInputs = $objRolePermissions->getAttributes();
            $arrPermissions = $arrValidatedInputs['permission'];
            $arrRecord = [];
            $arrDefaults = $objRolePermissions->getDefaults();
            foreach ($arrPermissions as $strKey => $strValue) {
                $arrRecord = [
                    'role' => $arrValidatedInputs['role'],
                    'permission' => $strKey,
                    'status' => $arrValidatedInputs['status']
                ];
                $arrRecord = array_merge($arrRecord, $arrDefaults);
                $arrResponse['new'][] = $arrRecord;
            }
        } else {
            $arrResponse['errors'] = $objRolePermissions->errors;
        }
        $intInsert = ! isset($arrResponse['errors']) ? $objRolePermissions->create($arrResponse['new']) : 0;
        unset($arrResponse);
        $arrResponse['inserted_count'] = $intInsert;
        unset($arrInputs, $intInsert);
        return $arrResponse;
    }

    public function actionCreateUser()
    {
        $arrResponse = [];
        $arrRoles = Roles::find()->select([
            'id',
            'name'
        ])
            ->asArray()
            ->all();
        $arrInputs = Yii::$app->request->post();
//         $arrInputs = [
//             'fullname' => 'Meda Vinod Kumar',
//             'role_id' => 1,
//             'role_name' => 'admin',
//             'email' => 'vinods@gmail.com',
//             'phone' => '9705899270',
//             'status' => 'active'
//         ];
        $arrResponse = ! empty($arrInputs) ? $this->saveUser($arrInputs) : [];
        //print_r($arrResponse);
        //die();
        return $this->render('/User', [
            'roles' => $arrRoles,
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    private function saveUser($arrInputs)
    {
        $arrResponse = [];
        $objUsers = new Users();
        $arrDefaults = $objUsers->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objUsers->attributes = $arrInputs;
        if ($objUsers->validate()) {
            $objUsers->save();
            $arrResponse['user_id'] = $objUsers->id;
        } else {
            $arrResponse['errors'] = $objUsers->errors;
        }
        unset($arrInputs, $arrDefaults);
        return $arrResponse;
    }

    public function actionResetPassword()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        
        return $this->render('/ResetPassword', [
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : []
        ]);
    }

    public function actionGenerateOtp()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrInputs = [
            'phone' => '9502038283'
        ];
        if (! empty($arrInputs)) {
            $arrUser = Users::getUsers([
                'phone' => $arrInputs['phone'],
                'status' => 'active'
            ]);
            $arrResponse = ! empty($arrUser) ? $this->sendToken($arrUser[0]) : 'Invalid Username';
            print_r($arrResponse);
            die();
            unset($arrInputs, $arrUser);
        }
        echo Json::encode($arrResponse);
    }

    private function sendToken($arrInputs)
    {
        $arrResponse = [];
        $objToken = new Token();
        $arrInputs['category_type'] = 'forgotpassword';
        $arrInputs['token'] = CommonComponent::getNumberToken();
        $arrDefaults = $objToken->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objToken->attributes = $arrInputs;
        if ($objToken->validate()) {
            $objToken->save();
            $arrResponse['token_id'] = $objToken->id;
            //Need To Insert Data Into SMS Table
            //Need To Insert Data Into Email Table
            //Need To Run Cron Job
        } else {
            $arrResponse['errors'] = $objToken->errors;
        }
        unset($arrInputs, $arrDefaults);
        return $arrResponse;
    }
}
