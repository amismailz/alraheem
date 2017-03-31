<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'الاعضاء');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'اضافة عضو'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('طباعة الكارنيهات', ['class'=>'btn btn-warning', 'id'=>'multi-cards', 'disabled'=>'', 'name'=>'cards', 'value'=>'1']) ?>
    </p>
    <?php //$form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl('condition/index'), 'method' => 'get', 'options' => ['target' => '_blank']]);
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'name',
            [
                'attribute' => 'job_id',
                'value' => 'job.title',
                'filter' => \backend\models\MemberJob::getAll()
            ],
            'cid',
            'phone',
            // 'address',
            'membership_number',
            [
                'label' => 'اشتراك هذا الشهر',
                'value' => function(\backend\models\Member $model) {
                    $payment = $model->payedThisMonth();
                    if ($payment)
                        return '<a id="on' . $model->id . '" class="btn btn-success" title="' . $payment->payed_at . '" href="' . Url::to(['payments', 'id' => $model->id]) . '"><i class="fa fa-check"></i></a>';
                    else
                        return '<a id="off' . $model->id . '" class="btn btn-danger" title="لم يتم الدفع" href="' . Url::to(['payments', 'id' => $model->id]) . '" ><i class="fa fa-close"></i></a>';
                },
                        'format' => 'raw',
                    ],
                    // 'photo',
                    // 'created_at',
                    // 'updated_at',
                    // 'created_by',
                    // 'updated_by',
                    [
                        'label' => 'الكارنيه',
                        'value' => function($model) {
                            return '<a class="btn btn-warning" title="اطبع الكارنيه" target="_blank" href="' . Url::to(['card', 'id' => $model->id]) . '"><i class="fa fa-barcode"></i></a>';
                        },
                                'format' => 'raw',
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php //ActiveForm::end(); ?>

</div>
<?php
//$script = <<< JS
//function activateAid()
//{
//    document.location.href="$url?aid="+$("#list").val();
//}
//function delivery(aid_id, model_id)
//{
//    var btn = $('#off'+model_id);
//    $.ajax({
//        url: "$delivery_url",
//        data: {'model_id': model_id, 'aid_id': aid_id},
//        beforeSend: function(){
//            btn.button('loading');
//        }
//
//        }).done(function (data) {
//            if(data == '1')
//                {              
//                    btn.removeClass('btn-danger').addClass('btn-success'); 
//                        setTimeout(function () {
//                                  btn.html('<i class="fa fa-check"></i>');
//                                }, 300)
//                }
//                else alert('Please verify your data and refresh the page.');
//                
//        }).fail(function() {
//            alert("Somthing Went Error.");
//            }).always(function() {
//                      btn.button('reset')
//        });
//}
//function cancel(aid_id, model_id)
//{
//    var btn = $('#on'+model_id);
//    $.ajax({
//        url: "$cancel_url",
//        data: {'model_id': model_id, 'aid_id': aid_id},
//        beforeSend: function(){
//            btn.button('loading');
//        }
//
//        }).done(function (data) {
//            if(data == '1')
//                {                   
//                    btn.removeClass('btn-success').addClass('btn-danger');
//                    setTimeout(function () {
//                                  btn.html('<i class="fa fa-close"></i>');
//                                }, 300)
//                    
//                }
//                else alert('Please verify your data and refresh the page.');
//                
//        }).fail(function() {
//            alert("Somthing Went Error.");
//        }).always(function() {         
//            btn.button('reset');               
//        });
//}
// 
//function showHistory(model_id)
//{
//   $('#modal-content').load("$history_url?model_id="+model_id);
//   $("#myModal").modal("show");
//}
//        
//$(document).on('change', ':checkbox', function (event){
//    if ($("td :checkbox:checked").length > 0)
//    {
//        $("#multi-cards").removeAttr('disabled');
//        $("#multi-cards-backs").removeAttr('disabled');
//    }
//    else
//    {
//        $("#multi-cards").attr('disabled', '');
//        $("#multi-cards-backs").attr('disabled', '');
//    }
//    //$("#sel").val($("td :checkbox:checked").map(function() {return this.value;}).get().join(','));
//});
//   
//JS;
//$this->registerJs($script, \yii\web\View::POS_END);    
?>
