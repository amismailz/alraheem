
<?php 
use barcode\barcode\BarcodeGenerator as BarcodeGenerator; 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConditionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="cards">
<div class="row">
    <?php if(!empty($selections)) foreach ($selections as $sel){ ?>
    <div class="card-item">
        <div>
            <img class="front-bg" src="<?= Yii::$app->request->baseUrl.'/img/back.png' ?>">
        </div>
</div>
    <?php } ?>
    
</div>
</div>

<?php
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/cards.css');
?>