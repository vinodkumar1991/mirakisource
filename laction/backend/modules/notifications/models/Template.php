<?php
namespace backend\modules\notifications\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Template extends ActiveRecord
{

    public static function tableName()
    {
        return 'templates';
    }

    public function rules()
    {
        return [
            [
                [
                    'message_type',
                    'senderid_id',
                    'code',
                    'name',
                    'template',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'from_email',
                    'description',
                    'created_date',
                    'created_by',
                    'last_modified_date',
                    'last_modified_by'
                ],
                'safe'
            ],
            [
                'code',
                'isValidCode'
            ],
            [
                'from_email',
                'email'
            ],
            [
                'description',
                'match',
                'pattern' => '/^[0-9a-zA-Z :\'";!@#$%^&*()-_+=?,.`~]+$/',
                'message' => 'Invalid Description'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'message_type' => 'Message Type',
            'from_email' => 'From Email',
            'senderid_id' => 'Subject',
            'code' => 'Template Code',
            'name' => 'Template Name',
            'template' => 'Template',
            'description' => 'Description',
            'status' => 'Status'
        ];
    }

    public function getDefaults()
    {
        return [
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1 // Need to change
        ];
    }

    public function isValidCode($attribute, $params)
    {
        $arrTemplate = self::getTemplates([
            'code' => $this->code,
            'id' => $this->id
        ]);
        if (! empty($arrTemplate)) {
            $this->addError($attribute, $attribute . ' is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getTemplates($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            't.id'
        ]);
        $objQuery->from('templates as t');
        // Message Type
        if (isset($arrInputs['message_type']) && ! empty($arrInputs['message_type'])) {
            $objQuery = $objQuery->andWhere('t.message_type=:MessageType', [
                ':MessageType' => $arrInputs['message_type']
            ]);
        }
        // Subject
        if (isset($arrInputs['code']) && ! empty($arrInputs['code'])) {
            $objQuery = $objQuery->andWhere('t.code=:Code', [
                ':Code' => $arrInputs['code']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('t.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
