<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "alr_delivery".
 *
 * @property integer $id
 * @property integer $condition_id
 * @property integer $aid_id
 * @property string $delivery_time
 * @property integer $delivered_by
 *
 * @property Condition $condition
 * @property Aid $aid
 * @property User $deliveredBy
 */
class Delivery extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'alr_delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['condition_id', 'aid_id', 'delivered_by'], 'integer'],
            [['delivery_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'condition_id' => Yii::t('app', 'Condition ID'),
            'aid_id' => Yii::t('app', 'Aid ID'),
            'delivery_time' => Yii::t('app', 'Delivery Time'),
            'delivered_by' => Yii::t('app', 'Delivered By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondition() {
        return $this->hasOne(Condition::className(), ['id' => 'condition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAid() {
        return $this->hasOne(Aid::className(), ['id' => 'aid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveredBy() {
        return $this->hasOne(User::className(), ['id' => 'delivered_by']);
    }

    public static function applyDelivery($aid_id, $condition_id) {
        $test = Delivery::find()->where(['aid_id' => $aid_id, 'condition_id' => $condition_id])->one();
        if ($test)
            return 0;
        $delivery = new Delivery;
        $delivery->aid_id = $aid_id;
        $delivery->condition_id = $condition_id;
        $delivery->delivery_time = date('Y-m-d H:i');
        $delivery->delivered_by = Yii::$app->user->identity->id;
        $delivery->save(false);
        return 1;
    }

}
