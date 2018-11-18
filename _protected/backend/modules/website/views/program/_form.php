<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-form">

    <?php $form = ActiveForm::begin(
    	[
    	'options' => ['enctype' => 'multipart/form-data']
    	]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro')->textArea(['maxlength' => 355]) ?>

    <?= $form->field($model, 'image', ['labelOptions'=>['label'=>'Image (width 1024 px)']])->fileInput() ?>
     <div class="form-group field-banner-image">
		<?php if($model->image != ''){
			echo Html::img(Yii::$app->request->baseUrl.'/media/program/'.$model->image, ['width'=>300, 'alt'=>'no image']);
		} ?>
 	</div>
 	<?= $form->field($model, 'details')->textarea(['rows' => 6])->widget(\mihaildev\ckeditor\CKEditor::className(), ['editorOptions'=>['language'=>'ar']]) ?>

    <!--?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <!--?= $form->field($model, 'home')->textInput() ?>

    <!--?= $form->field($model, 'slider')->textInput() ?>

    <!--?= $form->field($model, 'marquee')->textInput() ?>

    <!--?= $form->field($model, 'footer')->textInput() ?>

    <!--?= $form->field($model, 'publish')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
