<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use Yii;

class RolePermissions extends ActiveRecord
{

    public static function tableName()
    {
        return 'role_permissions';
    }

    public function rules()
    {
        return [
            [
                [
                    'role',
                    'permission',
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
            'role' => 'Role',
            'permission' => 'Permission',
            'status' => 'Status'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('role_permissions', [
            'role',
            'permission',
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
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1 // Need to change
        ];
    }
}
