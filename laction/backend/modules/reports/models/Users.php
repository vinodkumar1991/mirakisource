<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use Yii;
use common\components\CommonComponent;
use yii\db\Query;

class Users extends ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [
                [
                    'fullname',
                    'role_id',
                    'role_name',
                    'password',
                    'phone',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'email',
                    'image',
                    'created_date',
                    'created_by',
                    'last_modified_date',
                    'last_modified_by'
                ],
                'safe'
            ],
            [
                'email',
                'email'
            ],
            [
                [
                    'email'
                ],
                'string',
                'min' => 5,
                'max' => 40
            ],
            [
                [
                    'phone'
                ],
                'string',
                'min' => 10,
                'max' => 10
            ],
            [
                'phone',
                'match',
                'pattern' => '/^[0-9]+$/',
                'message' => 'Phone number allows only numerics'
            ],
            [
                [
                    'fullname'
                ],
                'string',
                'min' => 3,
                'max' => 100
            ],
            
            [
                'fullname',
                'match',
                'pattern' => '/^[a-zA-Z \']+$/',
                'message' => 'Fullname allows only alphabets'
            ],
            [
                [
                    'email',
                    'phone'
                ],
                'isValidInput'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'fullname' => 'Fullname',
            'role_id' => 'Role',
            'email' => 'Email',
            'phone' => 'Phone',
            'image' => 'Image',
            'status' => 'Status'
        ];
    }

    public function getDefaults()
    {
        return [
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1, // Need to change
            'password' => $this->getPassword()
        ];
    }

    public function isValidInput($attribute, $params)
    {
        $arrResponse = [];
        if (! empty($this->email)) {
            $arrResponse = self::getUsers([
                'email' => $this->email,
                'id' => $this->id
            ]);
        } else {
            $arrResponse = self::getUsers([
                'phone' => $this->phone,
                'id' => $this->id
            ]);
        }
        if (! empty($arrResponse)) {
            $this->addError($attribute, $attribute . ' already exists.');
            return false;
        } else {
            return true;
        }
    }

    private function getPassword()
    {
        $strPassword = CommonComponent::generatePassword();
        $strPassword = Yii::$app->getSecurity()->generatePasswordHash($strPassword);
        return $strPassword;
    }

    public static function getUsers($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'u.fullname',
            'u.id as user_id',
            'u.phone',
            'u.password',
            'u.role_id',
            'u.role_name',
            'u.email',
            'u.status'
        ]);
        $objQuery->from('users as u');
        // Email
        if (isset($arrInputs['email']) && ! empty($arrInputs['email'])) {
            $objQuery = $objQuery->andWhere('u.email=:Email', [
                ':Email' => $arrInputs['email']
            ]);
        }
        // Phone
        if (isset($arrInputs['phone']) && ! empty($arrInputs['phone'])) {
            $objQuery = $objQuery->andWhere('u.phone=:Phone', [
                ':Phone' => $arrInputs['phone']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('u.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
