<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;

class Login extends ActiveRecord
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
                    'phone',
                    'password'
                ],
                'required',
                'on' => 'login',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'phone'
                ],
                'trim'
            ],
            [
                'phone',
                'string',
                'min' => 10,
                'max' => 10
            ],
            [
                'password',
                'string',
                'max' => 100
            ]
        ];
    }

    public function scenarios()
    {
        $arrScenarios = parent::scenarios();
        $arrScenarios['login'] = [
            'phone',
            'password'
        ];
        return $arrScenarios;
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Phone Number',
            'password' => 'Password'
        ];
    }
}
