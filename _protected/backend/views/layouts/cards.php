<?php

use backend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>طباعة الكارنيه</title>
        <style>@media print , screen {
                body{
                    -webkit-print-color-adjust: exact;
                    -o-print-color-adjust: exact;
                    -moz-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                .row{
                    width: 100%;
                    height: auto;
                }
                .left-col,
                .right-col{
                    width: 50%;
                    float: left;
                }
                .left-col .card-item{
                    margin-right: .75cm;
                    float: right;
                }
                .right-col .card-item{
                    margin-left: .75cm;
                    float: left;
                }
                .card-item{
                    width: 8.5cm;/*3.375in*/
                    height: 5.5cm;/*2.125in*/
                    position: relative;
                    display: block;
                    margin-top: 10px;
                    background-color: #f1f4f9;
                    -webkit-print-color-adjust: exact;
                    -moz-transform: matrix(-1, 0, 0, 1, 0, 0);
                    -webkit-transform: matrix(-1, 0, 0, 1, 0, 0);
                    -o-transform: matrix(-1, 0, 0, 1, 0, 0);
                }
                .header{
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                }
                .header h2{
                    text-align: center;
                    font-weight: 700;
                    font-size: 28px;
                    background-color: #fecc4e;
                    -webkit-print-color-adjust: exact;
                    margin-top: 0;
                    margin-bottom: 0;
                    font-family: "droid arabic kufi";
                    line-height: 45px;
                }
                .discription{
                    position: absolute;
                    bottom: 0;
                    right: 0;
                    width: 72%;
                    height: 156.5px;
                }
                figure{
                    position: relative;
                    width: 100%;
                    margin: 0;
                }
                .background{
                    width: 90%;
                    height: auto;
                    z-index: 0;
                }
                figcaption{
                    display: inline-block;
                    position: absolute;
                    bottom: 0;
                    right: 0;
                }
                table{
                    direction: rtl;
                }
                .name-row{
                    height: 45px;
                }
                tr{
                    display: inline-block;
                }
                .name-tag,.id-tag,.status-tag{
                    font-family: "droid arabic kufi";
                    font-weight:700;
                    font-size: 12px;
                    width: 80px;
                    margin: 0;
                }
                .name,.id-number,.status{
                    font-weight: 500;
                    width: 150px;
                    margin: 0;
                }
                .barcode{
                    text-align: center;
                }
                .side{
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    width: 28%;
                    padding-bottom: 8px;
                }
                .user-image{
                    width: 82px;
                    height: 100px;
                    border-radius: 4px;
                    margin-left: 8px;
                }
                .signature{
                    margin-top: -20px;
                    z-index: 999;
                }}
        </style>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
