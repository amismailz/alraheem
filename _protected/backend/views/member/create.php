<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Member */

$this->title = Yii::t('app', 'اضافة عضو');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'الاعضاء'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
