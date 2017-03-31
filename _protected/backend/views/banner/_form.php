<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
    	'options' => ['enctype' => 'multipart/form-data']
    	]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => 255]) ?>

    <!--?= $form->field($model, 'details')->widget(MultiLanguageActiveField::className(), ['inputType'=>'textArea']) ?-->

    <?= $form->field($model, 'image', ['labelOptions' => ['label' => 'Image (1600*600 px)']])->fileInput() ?>
    <div class="form-group field-banner-image">
        <?php
        if ($model->image != '') {
            echo Html::img(Yii::$app->request->baseUrl . '/media/banner/' . $model->image, ['width' => 300, 'alt' => 'no image']);
        }
        ?>
    </div>


    <!--?= $form->field($model, 'temp3')->textInput() ?>

    <!--?= $form->field($model, 'temp4')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
