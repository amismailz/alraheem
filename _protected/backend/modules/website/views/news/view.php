<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    

    <p>
    	<?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'News',
]), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'intro',
            'details:html',
			[
			'label'=>'Image',
			'value'=>Html::img(Yii::$app->request->baseUrl.'/media/news/'.$model->image, ['width'=>300, 'alt'=>'no image']),
			'format'=>'raw'
			],

            'date_created',
            //'slug',
            //'home',
            //'slider',
            //'marquee',
           // 'footer',
            //'publish',
        ],
    ]) ?>

</div>
