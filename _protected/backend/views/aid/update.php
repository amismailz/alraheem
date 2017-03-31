<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Aid */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Aid',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aid-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
