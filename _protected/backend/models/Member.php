<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_member".
 *
 * @property integer $id
 * @property string $name
 * @property integer $job_id
 * @property string $cid
 * @property string $phone
 * @property string $address
 * @property integer $membership_number
 * @property string $photo
 * @property string $amount
 * @property string $last_payment
 * @property string $last_thanks_sms
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property MemberJob $job
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['phone', 'string', 'max' => 11, 'min' => 11],
            [['job_id', 'cid', 'amount', 'membership_number', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'photo', 'last_payment', 'last_thanks_sms'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'job_id' => Yii::t('app', 'الوظيفة'),
            'cid' => Yii::t('app', 'Cid'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'membership_number' => Yii::t('app', 'رقم العضوية'),
            'photo' => Yii::t('app', 'Photo'),
            'amount' => Yii::t('app', 'المبلغ'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(MemberJob::className(), ['id' => 'job_id']);
    }
    
    public function payedThisMonth()
    {
        return MemberPayment::find()->where(['member_id'=>$this->id, 'month'=>date('m'), 'year'=>date('Y')])->one();
    }
    
    public function payments()
    {
        return MemberPayment::find()->where(['member_id'=>$this->id])->all();
    }
    
    public function firstYear()
    {
        $firstYearPayment = MemberPayment::find()->where(['member_id'=>$this->id])->orderBy('year')->one();
        return $firstYearPayment? $firstYearPayment->year : null;
    }
    
    public function isPayed($m, $y)
    {
        return MemberPayment::find()->where(['member_id'=>$this->id, 'month'=>$m, 'year'=>$y])->one();
    }
}