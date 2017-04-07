<?php

use barcode\barcode\BarcodeGenerator as BarcodeGenerator;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $models Condition[] */
$count = count($models);
$leftCol = array_slice($models, 0, intval($count / 2));
$rightCol = array_slice($models, intval($count / 2));
?>

<div class="row">
    <div class="left-col">
        <?php if (!empty($leftCol)) foreach ($leftCol as $item) { ?>
                <div class="card-item">
                    <div class="header">
                        <h2>جمعية الرحيم الخيرية</h2>
                    </div>
                    <div class="discription">
                        <figure>
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/front.png" class="background">
                            <figcaption>
                                <table>
                                    <tbody>
                                        <tr class="name-row">
                                            <td class="name-tag">الاســـــــــــــــم:</td>
                                            <td class="name"><?= $item->name ?></td>
                                        </tr>
                                        <tr>
                                            <td class="id-tag">رقم قومي:</td>
                                            <td class="id-number"><?= $item->cid ?></td>
                                        </tr>
                                        <tr>
                                            <td class="status-tag">الوظيفة:</td>
                                            <td class="status"><?= $item->job->title ?></td>
                                        </tr>
                                        <tr>
                                            <td class="status-tag">رقم العضوية:</td>
                                            <td class="status">(<?= $item->membership_number ?>)</td>
                                        </tr>
                                        <tr>
                                            <td class="barcode" colspan="2"><div id="<?= $item->id ?>"></div><span><?= $item->id ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="side">
                        <img src="<?= Yii::$app->request->baseUrl ?>/media/condition/<?= $item->photo? $item->photo : 'avatar.png' ?>" class="user-image">
                        <img src="<?= Yii::$app->request->baseUrl ?>/img/signature.png" class="signature">
                    </div>
                </div>
            <?php } ?>
    </div>
    <div class="right-col">
        <?php if (!empty($rightCol)) foreach ($rightCol as $item) { ?>
                <div class="card-item">
                    <div class="header">
                        <h2>جمعية الرحيم الخيرية</h2>
                    </div>
                    <div class="discription">
                        <figure>
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/front.png" class="background">
                            <figcaption>
                                <table>
                                    <tbody>
                                        <tr class="name-row">
                                            <td class="name-tag">الاســـــــــــــــم:</td>
                                            <td class="name"><?= $item->name ?></td>
                                        </tr>
                                        <tr>
                                            <td class="id-tag">رقم قومي:</td>
                                            <td class="id-number"><?= $item->cid ?></td>
                                        </tr>
                                        <tr>
                                            <td class="status-tag">الوظيفة:</td>
                                            <td class="status"><?= $item->job->title ?></td>
                                        </tr>
                                        <tr>
                                            <td class="status-tag">رقم العضوية:</td>
                                            <td class="status">(<?= $item->membership_number ?>)</td>
                                        </tr>
                                        <tr>
                                            <td class="barcode" colspan="2"><div id="<?= $item->id ?>"></div><span><?= $item->id ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="side">
                        <img src="<?= Yii::$app->request->baseUrl ?>/media/condition/<?= $item->photo? $item->photo : 'avatar.png' ?>" class="user-image">
                        <img src="<?= Yii::$app->request->baseUrl ?>/img/signature.png" class="signature">
                    </div>
                </div>
            <?php } ?>
    </div>
</div>
</div>    
<?php
foreach ($models as $model) {
    $optionsArray = [
        'settings' => [
            'output' => 'bmp', /* css, bmp, svg, canvas */
            'barHeight' => 35,
        ],
        'elementId' => $model->id, /* div or canvas id */
        'value' => $model->id, /* value for EAN 13 be careful to set right values for each barcode type */
        'type' => 'codabar', /* supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix */
    ];
    echo BarcodeGenerator::widget($optionsArray);
}