<?php
namespace backend\modules\reports\models;

use yii\db\ActiveRecord;
use Yii;

class Customers extends ActiveRecord
{

    public static function tableName()
    {
        return 'customer';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }
}
