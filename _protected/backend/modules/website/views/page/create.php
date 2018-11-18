<?php

use yii\helpers\Html;
use yii\helpers\Inflector;


/* @var $this yii\web\View */
/* @var $model backend\modules\website\models\Page */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Page',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Page'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
