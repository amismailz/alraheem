<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Condition */

$this->title = Yii::t('app', 'Add Condition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conditions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condition-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
