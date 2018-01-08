<?php
namespace backend\modules\uploads\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Slots extends ActiveRecord
{

    public static function tableName()
    {
        return 'slots';
    }

    public function rules()
    {
        return [
            [
                [
                    'category_type',
                    'event_date',
                    'from_time',
                    'to_time',
                    'amount',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'created_date',
                    'created_by',
                    'last_modified_date',
                    'last_modified_by'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'category_type' => 'Category Type',
            'event_date' => 'Event Date',
            'from_time' => 'From Time',
            'to_time' => 'To Time',
            'amount' => 'Amount',
            'status' => 'Status'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('slots', [
            'category_type',
            'event_date',
            'from_time',
            'to_time',
            'amount',
            'status',
            'created_date',
            'created_by'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function getDefaults()
    {
        return [
            'status' => 'active',
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1 // Need to change
        ];
    }

    public static function getSlots($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.id'
        ]);
        $objQuery->from('slots as s');
        // Event Date
        if (isset($arrInputs['event_date']) && ! empty($arrInputs['event_date'])) {
            $objQuery = $objQuery->andWhere('s.event_date=:eventDate', [
                ':eventDate' => $arrInputs['event_date']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public function updateSlot($arrWhere, $arrInputs)
    {
        $arrWhere = [
            'and',
            [
                'IN',
                'event_date',
                $arrWhere['event_dates']
            ],
            [
                'category_type' => $arrWhere['category_type']
            ]
        ];
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('slots', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
