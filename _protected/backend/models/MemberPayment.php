<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_member_payment".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $month
 * @property integer $year
 * @property string $amount
 * @property string $payed_at
 * @property integer $payed_by
 */
class MemberPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_member_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'month', 'year', 'payed_by'], 'integer'],
            [['amount'], 'number'],
            [['payed_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'amount' => Yii::t('app', 'Amount'),
            'payed_at' => Yii::t('app', 'Payed At'),
            'payed_by' => Yii::t('app', 'Payed By'),
        ];
    }
}
