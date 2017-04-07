<?php

namespace backend\controllers;

use Yii;
use backend\models\Member;
use backend\models\MemberSearch;
use backend\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\MemberPayment;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends BackendController
{
    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
        public function actionMultiCards($sel) {
        $this->layout = 'member-card-layout';
        $models = Member::find()->where(['in', 'id', explode(',', $sel)])->all();
        return $this->render('multi-cards', ['models' => $models]);
    }

    public function actionMultiCardsBacks($sel) {
        $this->layout = 'member-card-layout';
        return $this->render('multi-cards-backs', ['selections' => explode(',', $sel)]);
    }
    
    public function actionPayments($id)
    {
        $member = $this->findModel($id);
        return $this->render('member-payment', ['member'=>$member]);
    }

    public function actionApplyPayment($id, $y, $m)
    {
        $payment = new MemberPayment;
        $payment->member_id = $id;
        $payment->month = $m;
        $payment->year = $y;
        $payment->payed_at = date('Y-m-d H:i');
        $payment->payed_by = Yii::$app->user->identity->id;
        $payment->save();
        return $this->redirect(['payments', 'id'=>$id]);
    }
    
    public function actionCancelPayment($id, $y, $m)
    {
        MemberPayment::find()->where(['member_id'=>$id, 'year'=>$y, 'month'=>$m])->one()->delete();
        return $this->redirect(['payments', 'id'=>$id]);
    }
    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $ext = end((explode('.', $file->name)));
                $rand = Yii::$app->security->generateRandomString();
                $model->photo = $rand . '.' . $ext;
                $path = Yii::getAlias('@webroot') . '/media/member/' . $model->photo;
                $file->saveAs($path);
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
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old = $model->photo;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photo = $old;
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                if ($model->photo == '') {
                    $ext = end((explode('.', $file->name)));
                    $rand = Yii::$app->security->generateRandomString();
                    $model->photo = $rand . '.' . $ext;
                }
                $path = Yii::getAlias('@webroot') . '/media/member/' . $model->photo;
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
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
