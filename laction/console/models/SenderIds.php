<?php
namespace console\models;

use yii\db\ActiveRecord;
use Yii;

class SenderIds extends ActiveRecord
{

    public static function tableName()
    {
        return 'senderids';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }
}
