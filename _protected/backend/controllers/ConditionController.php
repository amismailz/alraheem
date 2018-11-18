<?php

namespace backend\controllers;

use Yii;
use backend\models\Condition;
use backend\models\ConditionSearch;
use backend\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use backend\models\Aid;
use yii\helpers\ArrayHelper;
use backend\models\Delivery;

/**
 * ConditionController implements the CRUD actions for Condition model.
 */
class ConditionController extends BackendController {

    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'condition' => Condition::className()
                ]
            ],
        ];
    }

    /**
     * Lists all Condition models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ConditionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSizeLimit = [1, 200];
        $dataProvider->pagination->setPageSize(16);
        $aid_list = ArrayHelper::map(Aid::find()->where(['active' => 1])->all(), 'id', 'title');
        if (Yii::$app->request->get('cardsBacks') && Yii::$app->request->get('selection'))
            return $this->redirect(['multi-cards-backs', 'selection' => Yii::$app->request->get('selection')]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'aid_list' => $aid_list,
        ]);
    }

    public function actionMultiCards($sel) {
        $this->layout = 'condition-card-layout';
        $models = Condition::find()->where(['in', 'id', explode(',', $sel)])->all();
        return $this->render('multi-cards', ['models' => $models]);
    }

    public function actionMultiCardsBacks($sel) {
        $this->layout = 'condition-card-layout';
        return $this->render('multi-cards-backs', ['selections' => explode(',', $sel)]);
    }

    public function actionActivateAid($aid = '') {
        Yii::$app->session['active_aid'] = $aid;
        return $this->redirect('index');
    }

    public function actionAjaxDelivery($aid_id, $model_id) {
        if ($aid_id > 0 && $model_id) {
            return Delivery::applyDelivery($aid_id, $model_id);
        }
        return 0;
    }

    public function actionBarcodeDelivery() {
        $model = new \backend\models\DeliveryForm;
        $aid_list = ArrayHelper::map(Aid::find()->where(['active' => 1])->all(), 'id', 'title');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $condition = Condition::findOne($model->condition_id);
            if (!$condition) {
                Yii::$app->session->setFlash('del-error', 'الحالة غير موجودة');
                return $this->refresh();
            }
            if (Delivery::applyDelivery($model->aid_id, $model->condition_id)) {
                Yii::$app->session->setFlash('success', 'تم التسليم بنجاح');
            } else {
                Yii::$app->session->setFlash('already-delivered', 'الحالة قد استلمت هذه المساعدة من قبل');
            }
            return $this->render('barcode-delivery', ['condition' => $condition, 'model' => $model, 'aid_list' => $aid_list]);
        }

        return $this->render('barcode-delivery', ['model' => $model, 'aid_list' => $aid_list]);
    }

    public function actionAjaxCancel($aid_id, $model_id) {
        if ($aid_id && $model_id) {
            $test = Delivery::deleteAll(['aid_id' => $aid_id, 'condition_id' => $model_id]);
            return 1;
        }
        return 0;
    }

    public function actionAjaxHistory($model_id) {
        $history = Delivery::find()->where(['condition_id' => $model_id])->all();
        $model = $this->findModel($model_id);
        return $this->renderAjax('history', ['model' => $model, 'history' => $history]);
    }

    public function actionCard($id) {
        $this->layout = 'card';
        $model = $this->findModel($id);
        return $this->render('card', ['model' => $model]);
    }

    /**
     * Displays a single Condition model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Condition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Condition();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $ext = end((explode('.', $file->name)));
                $rand = Yii::$app->security->generateRandomString();
                $model->photo = $rand . '.' . $ext;
                $path = Yii::getAlias('@webroot') . '/media/condition/' . $model->photo;
                $file->saveAs($path);
            }
            $file2 = \yii\web\UploadedFile::getInstance($model, 'papers_pdf');
            if (!empty($file2)) {
                $ext = end((explode('.', $file2->name)));
                $rand = Yii::$app->security->generateRandomString();
                $model->papers_pdf = $rand . '.' . $ext;
                $path = Yii::getAlias('@webroot') . '/media/condition/pdf/' . $model->papers_pdf;
                $file2->saveAs($path);
            }

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Condition model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $old = $model->photo;
        $old_pdf = $model->papers_pdf;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photo = $old;
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                if ($model->photo == '') {
                    $ext = end((explode('.', $file->name)));
                    $rand = Yii::$app->security->generateRandomString();
                    $model->photo = $rand . '.' . $ext;
                }
                $path = Yii::getAlias('@webroot') . '/media/condition/' . $model->photo;
                $file->saveAs($path);
            }
            $model->papers_pdf = $old_pdf;
            $file = \yii\web\UploadedFile::getInstance($model, 'papers_pdf');
            if (!empty($file)) {
                if ($model->papers_pdf == '') {
                    $ext = end((explode('.', $file->name)));
                    $rand = Yii::$app->security->generateRandomString();
                    $model->papers_pdf = $rand . '.' . $ext;
                }
                $path = Yii::getAlias('@webroot') . '/media/condition/pdf/' . $model->papers_pdf;
                $file->saveAs($path);
            }

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes the photo for an existing Condition model.
     * If delete is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePhoto($id) {
        $model = $this->findModel($id);
        $model->photo = '';
        $model->save(false);
        return $this->redirect(['update', 'id' => $model->id]);
    }
    /**
     * Deletes the photo for an existing Condition model.
     * If delete is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePdf($id) {
        $model = $this->findModel($id);
        $model->papers_pdf = '';
        $model->save(false);
        return $this->redirect(['update', 'id' => $model->id]);
    }

    /**
     * Deletes an existing Condition model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Condition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Condition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Condition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
