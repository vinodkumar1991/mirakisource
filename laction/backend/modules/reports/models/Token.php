<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;

class Token extends ActiveRecord
{

    public static function tableName()
    {
        return 'tokens';
    }

    public function rules()
    {
        return [
            [
                [
                    'user_id',
                    'category_type',
                    'token'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'created_date'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'user_id' => 'User',
            'category_type' => 'Category Type',
            'token' => 'Token'
        ];
    }

    public function getDefaults()
    {
        return [
            'created_date' => date('Y-m-d H:i:s')
        ];
    }
}
