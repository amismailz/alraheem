<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\website\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'عن الجمعية');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
            	'label'=>'image',
                'value'=>function ($data) {
                    return Html::img(Yii::$app->request->baseUrl.'/media/page/'.$data->image, ['width'=>200, 'alt'=>'no image']);
                    },
            	'format'=>'raw'
            ],
            // 'sort',
             'created_at',
             'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
