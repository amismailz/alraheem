<?php
$this->title = 'Print Card';
use barcode\barcode\BarcodeGenerator as BarcodeGenerator;
?>

<html>
    <center>
        <span style="font-size: 25px"><?= $model->name ?></span>
        <div id="showBarcode"></div>
    </center>
    
</html>
<?php
$optionsArray = array(
'elementId'=> 'showBarcode', /* div or canvas id*/
'value'=> $model->id, /* value for EAN 13 be careful to set right values for each barcode type */
'type'=>'codabar',/*supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix*/
 
);
echo BarcodeGenerator::widget($optionsArray);
