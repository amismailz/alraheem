<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ConditionType */

$this->title = Yii::t('app', 'Create Condition Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Condition Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condition-type-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
