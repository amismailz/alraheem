<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Member */

$this->title = Yii::t('app', $member->name.' - '.'الدفع');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'الاعضاء'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">
    <div class="member-form">

    <?php $form = ActiveForm::begin(); ?>

        <table class="table">
                <tbody>
                    <?php
    // Begin list from last payment year. If no payment at all, begin from current year
    $firstYear = $member->firstYear()? $member->firstYear() : date('Y');
    // Last year is the year after 6 months to support future payments
    $lastYear = intval(date('Y', strtotime("+6 months", time())));
    // loop over all months withen first year to last year
    for($y=$firstYear; $y<=$lastYear; $y++)
    {
        
        for($m=1; $m<=12; $m++)
        {
            echo '<tr>';
            $payment = $member->isPayed($m, $y);
            if($payment)
                    echo '<td><a class="btn btn-success" title="'.$payment->payed_at.'" href="'.Url::to(['cancel-payment', 'id'=>$member->id, 'y'=>$y, 'm'=>$m]).'" data-confirm="هل تريد الغاء الدفع بالفعل؟"><i class="fa fa-check"></i></a> </td>';
            else
                    echo '<td><a class="btn btn-danger" title="لم يتم الدفع" href="'.Url::to(['apply-payment', 'id'=>$member->id, 'y'=>$y, 'm'=>$m]).'"><i class="fa fa-close"></i></a></td>';
            echo '<td>'.$m.'/'.$y.'</td>';
        echo '</tr>';
        }
        
    }
    ?>
                    
        </tbody>
        </table>
    
    <div class="form-group">
        <?= Html::submitButton('حفظ', ['class' => 'btn btn-primary']) ?>
    </div>

</div>
<?php ActiveForm::end(); ?>

</div>