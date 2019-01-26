<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\Aid */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="del-result">
    <?php if(Yii::$app->session->hasFlash('err')){ ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('err') ?>
    </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('success')){ ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php } ?>
</div>
<br>
<div class="delivery-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-inline']]); ?>

    <?= Html::label('أدخل رقم العضوية', 'barcode-field' ); ?>
    <?= Html::textInput('member_id', '', ['class'=>'form-control input-lg, text-bg', 'id'=>'barcode-field']); ?>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs('$(function() {
  $("#barcode-field").val("");
  $("#barcode-field").focus();
});') ?>
