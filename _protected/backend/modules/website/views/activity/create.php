<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Activity */

$this->title = 'Create Activity';
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
