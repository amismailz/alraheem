<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MemberJob */

$this->title = Yii::t('app', 'اضافة وظيفة');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'وظائف الاعضاء'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-job-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
