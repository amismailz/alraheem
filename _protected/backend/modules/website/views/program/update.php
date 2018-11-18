<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\website\models\Program */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Program',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Programs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="program-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
