<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_member_job".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Member[] $members
 */
class MemberJob extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_member_job';
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
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['job_id' => 'id']);
    }
    
    public static function getAll()
    {
        return \yii\helpers\ArrayHelper::map(static::find()->all(), 'id', 'title');
    }
}
