<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aids');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aid-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aid'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'date',
            'qty',
            [
                'attribute'=>'current_qty',
                'value'=>function($model){
                    return $model->currentQty;
                }
            ],
            
            'price',
            'periodic:boolean',
            'active:boolean',
            // 'notes:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=>['style'=>'width:90px']
            ],
        ],
    ]); ?>

</div>
