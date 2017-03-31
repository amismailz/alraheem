<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Aid */

$this->title = Yii::t('app', 'Create Aid');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aid-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
