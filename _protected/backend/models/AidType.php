<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_aid_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property Condition[] $conditions
 */
class AidType extends \yii\db\ActiveRecord
{
    const TYPE_MONTHLY = 1;
    const TYPE_SEASONLY = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_aid_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 10],
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
        return $this->hasMany(Condition::className(), ['aid_type_id' => 'id']);
    }
    
    public static function getAll()
    {
        return \yii\helpers\ArrayHelper::map(AidType::find()->all(), 'id', 'title');
    }
    
}
