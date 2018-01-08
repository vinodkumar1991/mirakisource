<?php
namespace common\components;

use yii\db\ActiveRecord;
use yii\base\Behavior;

class CommonModel extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate'
        ];
    }

    public function beforeValidate($event)
    {
        
    }
}