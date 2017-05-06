<?php

namespace backend\modules\website\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\website\models\News;
use backend\modules\website\models\NewsSearch;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BaseController {

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new News();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->date_created = Yii::$app->formatter->asDate($model->date_created, "Y-M-d");
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $file = \yii\web\UploadedFile::getInstance($model, 'image');

            if (!empty($file)) {
                // store the source file name
                $ext = end((explode(".", $file->name)));
                // generate a unique file name
                $rand = Yii::$app->security->generateRandomString();
                $model->image = $rand . ".{$ext}";
                // the path to save file, you can set an uploadPath
                $path = Yii::getAlias('@webroot') . '/media/news/' . $model->image;
                $file->saveAs($path);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            if ($model->image != '') {
                $_POST['News']['image'] = $model->image;
            }
            $model->load(Yii::$app->request->post());
            $model->date_created = Yii::$app->formatter->asDate($model->date_created, "Y-M-d");
            $file = \yii\web\UploadedFile::getInstance($model, 'image');

            if (!empty($file)) {
                if ($model->image == '') {
                    // store the source file name
                    $ext = end((explode(".", $file->name)));
                    // generate a unique file name
                    $rand = Yii::$app->security->generateRandomString();
                    $model->image = $rand . ".{$ext}";
                }

                // the path to save file, you can set an uploadPath
                $path = Yii::getAlias('@webroot') . '/media/news/' . $model->image;
                $file->saveAs($path);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
