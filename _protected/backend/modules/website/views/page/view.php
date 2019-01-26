<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $model backend\modules\website\models\Page */

$this->title = $model->title;

?>
<div class="page-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'details:html',
            [
                'label' => 'Image',
                'value' => Html::img(Yii::$app->request->baseUrl . '/media/page/' . $model->image, ['width' => 600, 'alt' => 'no image']),
                'format' => 'raw'
            ],
//            'sort',
            'created_at',
            'updated_at'
            ],
    ]) ?>

</div>
