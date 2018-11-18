<?php

namespace backend\modules\website\controllers;

use Yii;
use backend\modules\website\models\Activity;
use backend\modules\website\models\ActivitySearch;
use yii\web\NotFoundHttpException;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class DefaultController extends BaseController {

     /* Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     * Homepage for website admin area.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }
}
