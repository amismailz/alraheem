<?php

namespace backend\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "alr_aid".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property integer $qty
 * @property integer $price
 * @property integer $periodic
 * @property integer $active
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Delivery[] $deliveries
 */
class Aid extends \yii\db\ActiveRecord
{
    public $current_qty;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_aid';
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                //'createdAtAttribute' => 'create_time',
                //'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ], 
            BlameableBehavior::className(),
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['qty', 'price', 'periodic', 'active','created_by', 'updated_by', 'current_qty'], 'integer'],
            [['notes'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'date' => Yii::t('app', 'Date'),
            'qty' => Yii::t('app', 'Qty'),
            'current_qty' => Yii::t('app', 'Current Qty'),
            'price' => Yii::t('app', 'Price'),
            'periodic' => Yii::t('app', 'Periodic'),
            'active' => Yii::t('app', 'Active'),
            'notes' => Yii::t('app', 'Notes'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['aid_id' => 'id']);
    }
    
    public function getCurrentQty()
    {
        return $this->qty - Delivery::find()->where(['aid_id'=>$this->id])->count();
    }
}
