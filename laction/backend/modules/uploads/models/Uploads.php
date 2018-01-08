<?php
namespace backend\modules\uploads\models;

use yii\db\ActiveRecord;

class Uploads extends ActiveRecord
{

    public static function tableName()
    {
        return 'uploads';
    }

    public function rules()
    {
        return [
            [
                [
                    'file_type',
                    'publish_date',
                    'status'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'file_link',
                    'created_date',
                    'created_by',
                    'last_modified_date',
                    'last_modified_by'
                ],
                'safe'
            ],
            [
                'file_link',
                'url',
                'defaultScheme' => NULL
            ],
            [
                [
                    'file_link'
                ],
                'string',
                'max' => 2225
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'file_type' => 'File Type',
            'file_link' => 'File Path',
            'publish_date' => 'Publish Date',
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
}
