<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MemberJob */

$this->title = Yii::t('app', 'تعديل الوظيفة ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'وظائف الاعضاء'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="member-job-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
