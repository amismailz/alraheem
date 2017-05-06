<?php

namespace backend\modules\website;

class Website extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\website\controllers';

    public function init()
    {
        parent::init();

        $this->layout = 'main';
        // custom initialization code goes here
    }
}
