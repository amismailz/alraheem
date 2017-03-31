<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\Aid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aid_id')->dropDownList($aid_list, ['prompt'=>'اختر نوع المساعدة']) ?>
    <?= $form->field($model, 'condition_id')->textInput(['class'=>'form-control input-lg, text-bg', 'id'=>'barcode-field']) ?>

    <?php ActiveForm::end(); ?>

</div>
<div class="del-result">
    <?php if(Yii::$app->session->hasFlash('del-error')){ ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('del-error') ?>
    </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('already-delivered')){ ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('already-delivered') ?>
    </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('success')){ ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php } ?>
    <?php if(isset($condition)){ ?>
    <?= DetailView::widget([
        'model' => $condition,
        'attributes' => [
            'id',
            'name',
            'address',
            'phone',
            'mobile',
            [
                'attribute'=>'type_id',
                'value'=>$condition->type? $condition->type->title : Yii::t('app', 'Not set')
            ],
            [
                'attribute'=>'zone_id',
                'value'=>$condition->zone? $condition->zone->title : Yii::t('app', 'Not set')
            ],
            [
                'attribute'=>'aid_type_id',
                'value'=>$condition->aidType? $condition->aidType->title : Yii::t('app', 'Not set')
            ],
            
            'cid',
            'husband_name',
            'husband_cid',
            'research_num',
            'num_person',
            [
                'attribute' => 'photo',
                'value' => Html::img(Yii::$app->request->baseUrl . '/media/condition/' . $condition->photo, ['width' => 300]),
                'format' => 'raw'
            ],
            'notes:ntext',
            'created_at',
            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>
    
    <?php } ?>
</div>

<?php $this->registerJs('$(function() {
  $("#barcode-field").val("");
  $("#barcode-field").focus();
});') ?>
