<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ConditionType */

$this->title = Yii::t('app', 'Update', [
    'modelClass' => 'Condition Type',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Condition Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="condition-type-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
