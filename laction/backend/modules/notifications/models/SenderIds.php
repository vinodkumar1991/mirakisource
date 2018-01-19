<?php
namespace backend\modules\notifications\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class SenderIds extends ActiveRecord
{

    public static function tableName()
    {
        return 'senderids';
    }

    public function rules()
    {
        return [
            [
                [
                    'message_type',
                    'category_type',
                    'subject',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'route',
                    'created_date',
                    'created_by',
                    'last_modified_date',
                    'last_modified_by'
                ],
                'safe'
            ],
            [
                [
                    'subject'
                ],
                'string',
                'min' => 6,
                'max' => 135
            ],
            [
                'subject',
                'isValidSubject'
            ],
            
            // Need To Implement
            // Sender ID,While using route4 sender id should be 6 characters long.
            [
                'route',
                'isValidRoute'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'message_type' => 'Message Type',
            'category_type' => 'Category Type',
            'subject' => 'Subject',
            'route' => 'Route',
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

    public function isValidSubject($attribute, $params)
    {
        $arrSenderId = self::getSenderIds([
            'message_type' => $this->message_type,
            'category_type' => $this->category_type,
            'subject' => $this->subject,
            'id' => $this->id
        ]);
        if (! empty($arrSenderId)) {
            $this->addError($attribute, $attribute . ' is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getSenderIds($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.subject',
            's.message_type',
            's.category_type',
            's.id as sender_id',
            's.route',
            's.status'
        ]);
        $objQuery->from('senderids as s');
        // Message Type
        if (isset($arrInputs['message_type']) && ! empty($arrInputs['message_type'])) {
            $objQuery = $objQuery->andWhere('s.message_type=:MessageType', [
                ':MessageType' => $arrInputs['message_type']
            ]);
        }
        // Category Type
        if (isset($arrInputs['category_type']) && ! empty($arrInputs['category_type'])) {
            $objQuery = $objQuery->andWhere('s.category_type=:CategoryType', [
                ':CategoryType' => $arrInputs['category_type']
            ]);
        }
        // Subject
        if (isset($arrInputs['subject']) && ! empty($arrInputs['subject'])) {
            $objQuery = $objQuery->andWhere('s.subject=:Subject', [
                ':Subject' => $arrInputs['subject']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('s.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Sender Id
        if (isset($arrInputs['sender_id']) && ! empty($arrInputs['sender_id'])) {
            $objQuery = $objQuery->andWhere('s.id=:senderId', [
                ':senderId' => $arrInputs['sender_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public function isValidRoute($attribute, $params)
    {
        if (! empty($this->route)) {
            $intSubject = strlen($this->subject);
            if ((4 == $this->route && 'transactional' == $this->category_type) && 6 != $intSubject) {
                $this->addError('subject', 'Subject should be 6 charcters only.');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}
