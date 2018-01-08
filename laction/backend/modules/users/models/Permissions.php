<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;

class Permissions extends ActiveRecord
{

    public static function tableName()
    {
        return 'permissions';
    }
}
