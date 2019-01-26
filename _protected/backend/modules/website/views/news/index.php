<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modelsNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'News',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
    	return Html::img(Yii::$app->request->baseUrl.'/media/news/'.$data->image, ['width'=>200, 'alt'=>'no image']);
    },
    'format'=>'raw'
    ],
//    'date_created',
            //
            // 'slug',
            // 'home',
            // 'slider',
            // 'marquee',
            // 'footer',
            // 'publish',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
