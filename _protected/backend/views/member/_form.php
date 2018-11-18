<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_id')->dropDownList(backend\models\MemberJob::getAll()) ?>

    <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'membership_number')->textInput() ?>
    
    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'photo', ['labelOptions'=>['label'=>'صورة '.' 90*110']])->fileInput() ?>
    
    <?php if($model->photo != ''){ ?>
    <p>
    <?= Html::img(Yii::$app->request->baseUrl.'/media/member/'.$model->photo, ['width'=>300]) ?>
        <br/>
        <?= Html::a('حذف', Url::to(['delete-photo', 'id'=>$model->id]), ['data'=>['confirm'=>'هل تريد حذف الصورة بالفعل؟']]) ?>
    </p>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
