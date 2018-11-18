<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Program */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Program',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Program'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
