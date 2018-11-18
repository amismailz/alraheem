<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'الاعضاء');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $columns = [
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
        'amount',
        [
            'label' => 'اشتراك هذا الشهر',
            'value' => function(\backend\models\Member $model) {
                $payment = $model->payedThisMonth();
                if ($payment)
                    return '<a id="' . $model->id . '" class="btn btn-success" title="' . $payment->payed_at . '" href="javascript:toggleThisMonth(\''.$model->id.'\')"><i class="fa fa-check"></i></a>';
                else
                    return '<a id="' . $model->id . '" class="btn btn-danger" title="لم يتم الدفع" href="javascript:toggleThisMonth(\''.$model->id.'\')" ><i class="fa fa-close"></i></a>';
            },
                    'format' => 'raw',
        ],
        [
            'label' => '',
            'value' => function($model) {
                return '<a class="btn bg-yellow" href="' . Url::to(['payments', 'id' => $model->id]) . '">عرض الأشهر</a>';
            },
            'format' => 'raw',
        ],
        // 'photo',
        // 'created_at',
        // 'updated_at',
        // 'created_by',
        // 'updated_by',
        ['class' => 'yii\grid\ActionColumn'],
        ];
        echo DynaGrid::widget([
            'columns' => $columns,
            'storage' => DynaGrid::TYPE_COOKIE,
            'theme' => 'panel-danger',
            'gridOptions' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'panel' => [
                    //'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Library</h3>',
                    'before' => '{summary}',
                //'after' => false
                ],
                'toolbar' => [
                    ['content' =>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['title' => 'اضافة عضو', 'class' => 'btn btn-success']) . ' ' .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'الغاء البحث'])
                    ],
                    ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
                    '{export}',
                    ['content' => Html::a('طباعة الكارنيهات', 'javascript:multiCards(0);', ['class' => 'btn btn-warning', 'id' => 'multi-cards', 'disabled' => '', 'name' => 'cards', 'value' => '1'])],
                    ['content' => Html::a('طباعة الظهر', 'javascript:multiCards(1);', ['class' => 'btn btn-warning', 'id' => 'multi-cards-backs', 'disabled' => '', 'name' => 'cardsBacks', 'value' => '1'])],
                    ['content' => Html::a('الدفع بالباركود', Yii::$app->urlManager->createUrl('member/barcode-payment'), ['class' => 'btn btn-info'])],
                ]
            ],
            'options' => ['id' => 'dynagrid-2'] // a unique identifier is important
        ]);
        ?>

</div>
<?php
$this->registerCss('.panel-heading {display: none} '
        . '.summary{ float: left;}');
$baseUrl = Yii::$app->request->baseUrl;

$script = <<< JS
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
});
        
function multiCards(backs) {
        if(backs == 0)
            document.location.href="$baseUrl/member/multi-cards?sel="+$("td :checkbox:checked").map(function() {return this.value;}).get().join(',');
        else
            document.location.href="$baseUrl/member/multi-cards-backs?sel="+$("td :checkbox:checked").map(function() {return this.value;}).get().join(',');
        }
        
function toggleThisMonth(model_id)
{
    var btn = $('#'+model_id);
    $.ajax({
        url: "$baseUrl/member/toggle-payment?id="+model_id,
        beforeSend: function(){
            //btn.button('loading');
        }

        }).done(function (data) {
            if(data == 'cancel') {                   
                    btn.removeClass('btn-success').addClass('btn-danger');
                    btn.html('<i class="fa fa-close"></i>');
                    
                }
            else if (data == 'pay') {
                    btn.removeClass('btn-danger').addClass('btn-success');
                    btn.html('<i class="fa fa-check"></i>');
            }
            else {
                    alert('نأسف ! لقد حدث خطأ');
                }
                
        }).fail(function() {
            alert("خطأ");
        }).always(function() {         
            //btn.button('reset');               
        });
}
function payThisMonth(model_id)
{
    var btn = $('#'+model_id);
    $.ajax({
        url: "$baseUrl/member/apply-payment?id="+model_id,
        beforeSend: function(){
            //btn.button('loading');
        }

        }).done(function (data) {
            if(data == '1')
                {                   
                    btn.removeClass('btn-danger').addClass('btn-success');
                    btn.html('<i class="fa fa-check"></i>');
                    
                }
                else alert('نأسف ! لقد حدث خطأ');
                
        }).fail(function() {
            alert("Somthing Went Error.");
        }).always(function() {         
            //btn.button('reset');               
        });
}
JS;
                $this->registerJs($script, \yii\web\View::POS_END);
                ?>
