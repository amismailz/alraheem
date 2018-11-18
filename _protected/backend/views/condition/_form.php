<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Condition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="condition-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(backend\models\ConditionType::getAll(), ['prompt'=>Yii::t('app', 'Select Type')]) ?>

    <?= $form->field($model, 'zone_id')->dropDownList(\backend\models\Zone::getAll(), ['prompt'=>Yii::t('app', 'Select Zone')]) ?>

    <?= $form->field($model, 'aid_type_id')->dropDownList(backend\models\AidType::getAll(), ['prompt'=>Yii::t('app', 'Select Aid Type')]) ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <?= $form->field($model, 'husband_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'husband_cid')->textInput() ?>

    <?= $form->field($model, 'research_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_person')->textInput() ?>
    
    <?= $form->field($model, 'photo', ['labelOptions'=>['label'=>'صورة '.' 90*110']])->fileInput() ?>
    <?php if($model->photo != ''){ ?>
    <p>
    <?= Html::img(Yii::$app->request->baseUrl.'/media/condition/'.$model->photo, ['width'=>300]) ?>
        <br/>
        <?= Html::a('حذف', Url::to(['delete-photo', 'id'=>$model->id]), ['data'=>['confirm'=>'هل تريد حذف الصورة بالفعل؟']]) ?>
    </p>
    <?php } ?>
    <?php if(!$model->isNewRecord){ ?>     
        <h3>صور الاوراق</h3>
        <?php
            echo GalleryManager::widget(
                [
                    'model' => $model,
                    'behaviorName' => 'galleryBehavior',
                    'apiRoute' => 'condition/galleryApi'
                ]
            );
         ?>
<?php }else{ ?>
        <h3>Image Gallery </h3>
        <h4>Please save first in order to add photos.</h4>
<?php } ?>
    
    <?= $form->field($model, 'papers_pdf')->fileInput() ?>
    <?php if($model->papers_pdf != ''){ ?>
    <p>
    <?= Html::a(Html::img(Yii::$app->request->baseUrl.'/img/pdf.png', ['width'=>80]), Yii::$app->request->baseUrl.'/madia/condition/pdf/'.$model->papers_pdf, ['target' => '_blank']) ?>
        <br/>
        <?= Html::a('حذف', Url::to(['delete-pdf', 'id'=>$model->id]), ['data'=>['confirm'=>'هل تريد حذف الملف بالفعل؟']]) ?>
    </p>
    <?php } ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
