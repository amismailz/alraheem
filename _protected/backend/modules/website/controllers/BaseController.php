<?php

namespace backend\modules\website\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class BaseController extends Controller {

    public $enableCsrfValidation = false;

    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return Yii::$app->user->can('admin');
                },
                    ]
                ], // rules
            ], // access
        ]; // return
    }

// behaviors
}
