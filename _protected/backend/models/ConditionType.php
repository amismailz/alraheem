<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_condition_type".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Condition[] $conditions
 */
class ConditionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_condition_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditions()
    {
        return $this->hasMany(Condition::className(), ['type_id' => 'id']);
    }
    
    public static function getAll()
    {
        return \yii\helpers\ArrayHelper::map(ConditionType::find()->all(), 'id', 'title');
    }
}
