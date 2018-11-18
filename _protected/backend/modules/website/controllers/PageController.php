<?php

namespace backend\modules\website\controllers;

use Yii;
use backend\modules\website\models\Page;
use backend\modules\website\models\PageSearch;
use backend\modules\website\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use yii\filters\AccessControl;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends BaseController
{
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
                'only'=>['delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['theCreator']
                    ],
                ], // rules
            ], // access
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs
        ]; // return
    }
    
    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'page' => Page::className()
                ]
            ],
        ];
    }
    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex($type)
    {
        if(!in_array($type, [Page::TYPE_INTRO, Page::TYPE_FACILITY, Page::TYPE_OWN]))
            throw new NotFoundHttpException('The requested page does not exist.');
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['type'=>$type]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        if(!in_array($type, [Page::TYPE_INTRO, Page::TYPE_FACILITY, Page::TYPE_OWN]))
            throw new NotFoundHttpException('The requested page does not exist.');
        $model = new Page();
        $model->type = $type;
    	if (Yii::$app->request->isPost) {
    		$model->load(Yii::$app->request->post());

    		// get the uploaded file instance. for multiple file uploads
    		// the following data will return an array
    		$file = \yii\web\UploadedFile::getInstance($model, 'image');

    		if(!empty($file))
    		{
    			// store the source file name
    			$ext = end((explode(".", $file->name)));
    			// generate a unique file name
    			$rand = Yii::$app->security->generateRandomString();
    			$model->image = $rand.".{$ext}";
    			// the path to save file, you can set an uploadPath
    			$path = Yii::getAlias('@webroot') .'/media/page/'.$model->image;
    			$file->saveAs($path);

    		}
    			if($model->save()){
    				return $this->redirect(['view', 'id'=>$model->id, 'type'=>$type]);
    			}
    	}
    		return $this->render('create', [
    		'model' => $model,
    		]);

    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

    	if (Yii::$app->request->isPost) {
    		if( $model->image != ''){
    			$_POST['Page']['image'] = $model->image;
    		}
    		$model->load(Yii::$app->request->post());

    		$file = \yii\web\UploadedFile::getInstance($model, 'image');

    	if(!empty($file))
    	{
    		if($model->image =='')
    		{
    			// store the source file name
    			$ext = end((explode(".", $file->name)));
    			// generate a unique file name
    			$rand = Yii::$app->security->generateRandomString();
    			$model->image = $rand.".{$ext}";
    		}

    		// the path to save file, you can set an uploadPath
    		$path = Yii::getAlias('@webroot') .'/media/page/'.$model->image;
    		$file->saveAs($path);

    	}
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'type'=>$model->type]);
        } }

			return $this->render('update', [
                'model' => $model,
            ]);

    }
    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'type'=>$model->type]);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
