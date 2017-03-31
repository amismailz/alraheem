<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Condition */

$this->title = Yii::t('app', 'Update Condition', [
    'modelClass' => 'Condition',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conditions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="condition-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
