<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Condition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conditions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condition-view">

    <p>
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
            'id',
            'name',
            'address',
            'phone',
            'mobile',
            [
                'attribute'=>'type_id',
                'value'=>$model->type? $model->type->title : Yii::t('app', 'Not set')
            ],
            [
                'attribute'=>'zone_id',
                'value'=>$model->zone? $model->zone->title : Yii::t('app', 'Not set')
            ],
            [
                'attribute'=>'aid_type_id',
                'value'=>$model->aidType? $model->aidType->title : Yii::t('app', 'Not set')
            ],
            
            'cid',
            'husband_name',
            'husband_cid',
            'research_num',
            'num_person',
            [
                'attribute' => 'photo',
                'value' => Html::img(Yii::$app->request->baseUrl . '/media/condition/' . $model->photo, ['width' => 300]),
                'format' => 'raw'
            ],
            'notes:ntext',
            'created_at',
            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>

</div>
