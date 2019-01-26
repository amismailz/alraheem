<?php

namespace backend\modules\website\models;

use Yii;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $details
 * @property string $image
 * @property integer $button_text
 */
class Banner extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{web_banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'file'],
            [['link'], 'url'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'image' => 'Image'
            ];
    }
}
