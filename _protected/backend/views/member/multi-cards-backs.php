
<?php 
use barcode\barcode\BarcodeGenerator as BarcodeGenerator; 

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $models Condition[] */
$count = count($selections);
$leftCol = array_slice($selections, 0, intval($count / 2));
$rightCol = array_slice($selections, intval($count / 2));
?>

<div class="row">
    <div class="left-col">
        <?php if (!empty($leftCol)) foreach ($leftCol as $item) { ?>
                <div class="card-item">
                    <img src="<?= Yii::$app->request->baseUrl.'/img/back1.png' ?>" class="back-side">
                </div>
            <?php } ?>
    </div>
    <div class="right-col">
        <?php if (!empty($rightCol)) foreach ($rightCol as $item) { ?>
                <div class="card-item">
                    <img src="<?= Yii::$app->request->baseUrl.'/img/back1.png' ?>" class="back-side">
                </div>
            <?php } ?>
    </div>
</div>
</div>    