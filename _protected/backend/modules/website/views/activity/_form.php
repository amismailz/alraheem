<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model backend\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin([
    	'options' => ['enctype' => 'multipart/form-data']
    	]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'details')->textarea(['rows' => 6])->widget(\mihaildev\ckeditor\CKEditor::className(), ['editorOptions'=>['language'=>'ar']]) ?>
    <?= $form->field($model, 'image', ['labelOptions' => ['label' => 'Image (960*720 px)']])->fileInput() ?>
    <div class="form-group field-banner-image">
        <?php
        if ($model->image != '') {
            echo Html::img(Yii::$app->request->baseUrl . '/media/activity/' . $model->image, ['width' => 300, 'alt' => 'no image']);
        }
        ?>
    </div>
    <?= $form->field($model, 'sort')->textInput() ?>

    <?php if (!$model->isNewRecord) { ?>     
        <h3>Image Gallery</h3>
        <?php
        echo GalleryManager::widget(
                [
                    'model' => $model,
                    'behaviorName' => 'galleryBehavior',
                    'apiRoute' => 'activity/galleryApi'
                ]
        );
        ?>
<?php } else { ?>
        <h3>Image Gallery </h3>
        <h4>Please save first to add photos.</h4>
<?php } ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
