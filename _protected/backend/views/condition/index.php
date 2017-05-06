<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use backend\models\Condition;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConditionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Conditions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condition-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a(Yii::t('app', 'Add Condition'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php
    $columns = [
    ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    
        [
            'attribute'=>'id',
            'value'=>function($model){
                return '<a title="اعرض تاريخ التسليمات" class="btn btn-primary btn-xs" href="javascript:showHistory(\''.$model->id.'\')">'.$model->id.'</a>';
            },
            'format'=> 'raw',
            'contentOptions'=> ['style'=>'width:50px']
        ],
        [
            'attribute'=>'name',              
            'contentOptions'=> ['style'=>'font-weight: bold; font-size: 16px']
        ],
        'address',
        'phone',
        'mobile',
        'cid',
        [
            'attribute'=>'type_id',
            'value'=>function($model){
                    return $model->type? $model->type->title : Yii::t('app', 'Not set');
            },
            'filter'=> \backend\models\ConditionType::getAll()
        ],
        [
            'attribute'=>'zone_id',
            'value'=>function($model){
                    return $model->zone? $model->zone->title : Yii::t('app', 'Not set');
            },
            'filter'=> \backend\models\Zone::getAll()
        ],

        [
            'attribute'=>'aid_type_id',
            'value'=>function($model){
                    return $model->aidType? $model->aidType->title : Yii::t('app', 'Not set');
            },
                    'filter'=> \backend\models\AidType::getAll()
        ],
    
    [
        'class'=>'kartik\grid\ActionColumn',
        'dropdown'=>false,
        'order'=>DynaGrid::ORDER_FIX_RIGHT,
        'visible'=>Yii::$app->user->can('editor')
    ],
    [
        'label'=>'التسليم',
        'value'=>function($model){
                if(Yii::$app->session['active_aid'])
                {
                    $aid_id = Yii::$app->session['active_aid'];
                    $done = $model->checkAid($aid_id);
                    if($done)
                        return '<a id="on'.$model->id.'" class="btn btn-success" title="'.$done->delivery_time.'" href="javascript:cancel(\''.$aid_id.'\', \''.$model->id.'\')"><i class="fa fa-check"></i></a>';
                    else
                        return '<a id="off'.$model->id.'" class="btn btn-danger" title="لم يتم التسليم" href="javascript:delivery(\''.$aid_id.'\', \''.$model->id.'\')"><i class="fa fa-close"></i></a>';
                }
                
        },
                'format'=>'raw',
                'contentOptions'=>['style'=>'width:60px'],
                'visible'=>!empty(Yii::$app->session['active_aid'])
                
    ],
    [
        'label'=>'الكارنيه',
        'value'=>function($model){
                return '<a class="btn btn-warning" title="اطبع الكارنيه" target="_blank" href="'.Url::to(['card', 'id'=>$model->id]).'"><i class="fa fa-barcode"></i></a>';
        },
                'format'=>'raw',
                
    ],
    //['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
];
echo DynaGrid::widget([
    'columns'=>$columns,
    'storage'=>DynaGrid::TYPE_COOKIE,
    //'theme'=>false,
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'rowOptions'=>function(Condition $model){
            if($model->type_id == Condition::TYPE_REJECTED){
                return ['style' => 'background-color: #f56954 !important'];
            }
        },
        'panel'=>[
            //'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Library</h3>',
            'before' =>  '{summary}',
            //'after' => false
        ],        
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],['title'=>'اضافة حالة', 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'الغاء البحث'])
            ],
            ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
            ['content'=>  Html::dropDownList('aid', Yii::$app->session['active_aid'], $aid_list, ['class'=>'form-control', 'id'=>'list', 'prompt'=>'تسليم المساعدات'])],
            ['content'=>Html::a('تفعيل', 'javascript:activateAid();', ['class'=>'btn btn-success'])],
            ['content'=>Html::a('طباعة الكارنيهات', 'javascript:multiCards(0);', ['class'=>'btn btn-warning', 'id'=>'multi-cards', 'disabled'=>'', 'name'=>'cards', 'value'=>'1'])],
            ['content'=>Html::a('طباعة الظهر', 'javascript:multiCards(1);', ['class'=>'btn btn-warning', 'id'=>'multi-cards-backs', 'disabled'=>'', 'name'=>'cardsBacks', 'value'=>'1'])],
            ['content'=>Html::a('تسليم بالباركود', Yii::$app->urlManager->createUrl('condition/barcode-delivery'), ['class'=>'btn btn-info'])],
        ]
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]);
    ?>
</div>
<?php
Modal::begin([
    'id'=>'myModal',
    'header' => '<h2 id="modal-title">تاريخ الحالة</h2>',
]);

echo '<div id="modal-content"></div>';

Modal::end();
?>
<?php $this->registerCss('.panel-heading {display: none} '
        . '.summary{ float: left;}') ;
$baseUrl = Yii::$app->request->baseUrl;
$url = Yii::$app->urlManager->createUrl('condition/activate-aid') ;   
$delivery_url = Yii::$app->urlManager->createUrl('condition/ajax-delivery') ;   
$cancel_url = Yii::$app->urlManager->createUrl('condition/ajax-cancel') ;   
$history_url = Yii::$app->urlManager->createUrl('condition/ajax-history') ;   
$script = <<< JS
function activateAid()
{
    document.location.href="$url?aid="+$("#list").val();
}
function delivery(aid_id, model_id)
{
    var btn = $('#off'+model_id);
    $.ajax({
        url: "$delivery_url",
        data: {'model_id': model_id, 'aid_id': aid_id},
        beforeSend: function(){
            btn.button('loading');
        }

        }).done(function (data) {
            if(data == '1')
                {              
                    btn.removeClass('btn-danger').addClass('btn-success'); 
                        setTimeout(function () {
                                  btn.html('<i class="fa fa-check"></i>');
                                }, 300)
                }
                else alert('Please verify your data and refresh the page.');
                
        }).fail(function() {
            alert("Somthing Went Error.");
            }).always(function() {
                      btn.button('reset')
        });
}
function cancel(aid_id, model_id)
{
    var btn = $('#on'+model_id);
    $.ajax({
        url: "$cancel_url",
        data: {'model_id': model_id, 'aid_id': aid_id},
        beforeSend: function(){
            btn.button('loading');
        }

        }).done(function (data) {
            if(data == '1')
                {                   
                    btn.removeClass('btn-success').addClass('btn-danger');
                    setTimeout(function () {
                                  btn.html('<i class="fa fa-close"></i>');
                                }, 300)
                    
                }
                else alert('Please verify your data and refresh the page.');
                
        }).fail(function() {
            alert("Somthing Went Error.");
        }).always(function() {         
            btn.button('reset');               
        });
}
 
function showHistory(model_id)
{
   $('#modal-content').load("$history_url?model_id="+model_id);
   $("#myModal").modal("show");
}
        
$(document).on('change', ':checkbox', function (event){
    if ($("td :checkbox:checked").length > 0)
    {
        $("#multi-cards").removeAttr('disabled');
        $("#multi-cards-backs").removeAttr('disabled');
    }
    else
    {
        $("#multi-cards").attr('disabled', '');
        $("#multi-cards-backs").attr('disabled', '');
    }
    //$("#sel").val($("td :checkbox:checked").map(function() {return this.value;}).get().join(','));
});
        
function multiCards(backs) {
        if(backs == 0)
            document.location.href="$baseUrl/condition/multi-cards?sel="+$("td :checkbox:checked").map(function() {return this.value;}).get().join(',');
        else
            document.location.href="$baseUrl/condition/multi-cards-backs?sel="+$("td :checkbox:checked").map(function() {return this.value;}).get().join(',');
        }
   
JS;
$this->registerJs($script, \yii\web\View::POS_END);        
?>

