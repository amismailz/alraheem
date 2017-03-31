<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_file".
 *
 * @property integer $id
 * @property integer $cond_id
 * @property string $title
 * @property string $path
 * @property integer $created_by
 *
 * @property Condition $cond
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cond_id', 'created_by'], 'integer'],
            [['title', 'path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cond_id' => Yii::t('app', 'Cond ID'),
            'title' => Yii::t('app', 'Title'),
            'path' => Yii::t('app', 'Path'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCond()
    {
        return $this->hasOne(Condition::className(), ['id' => 'cond_id']);
    }
}
