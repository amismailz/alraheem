<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AidType */

$this->title = Yii::t('app', 'Create Aid Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aid Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aid-type-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
