<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;
use backend\modules\website\models\Page;
/* @var $this yii\web\View */
/* @var $model backend\modules\website\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, 'details')->widget(\mihaildev\ckeditor\CKEditor::className(), ['editorOptions'=>['language'=>'ar']]) ?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
