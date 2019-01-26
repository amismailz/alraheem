<?php

namespace backend\modules\website\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\website\models\Program;
use backend\modules\website\models\ProgramSearch;

/**
 * ProgramController implements the CRUD actions for Program model.
 */
class ProgramController extends BaseController {

    /**
     * Lists all Program models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Program model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Program();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $file = \yii\web\UploadedFile::getInstance($model, 'image');

            if (!empty($file)) {
                // store the source file name
                $arr = explode(".", $file->name);
                $ext = end($arr);
                // generate a unique file name
                $rand = Yii::$app->security->generateRandomString();
                $model->image = $rand . ".{$ext}";
                // the path to save file, you can set an uploadPath
                $path = Yii::getAlias('@webroot') . '/media/program/' . $model->image;
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
     * Updates an existing Program model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            if ($model->image != '') {
                $_POST['Program']['image'] = $model->image;
            }
            $model->load(Yii::$app->request->post());
            $file = \yii\web\UploadedFile::getInstance($model, 'image');

            if (!empty($file)) {
                if ($model->image == '') {
                    // store the source file name
                    $arr = explode(".", $file->name);
                    $ext = end($arr);
                    // generate a unique file name
                    $rand = Yii::$app->security->generateRandomString();
                    $model->image = $rand . ".{$ext}";
                }

                // the path to save file, you can set an uploadPath
                $path = Yii::getAlias('@webroot') . '/media/program/' . $model->image;
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
     * Deletes an existing Program model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Program model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Program the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Program::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
