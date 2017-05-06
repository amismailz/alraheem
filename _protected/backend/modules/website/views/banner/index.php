<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
            	'label'=>'image',
    			'value'=>function ($data) {
			    			return Html::img(Yii::$app->request->baseUrl.'/media/banner/'.$data->image, ['width'=>200, 'alt'=>'no image']);
			    },
            	'format'=>'raw'
			],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
