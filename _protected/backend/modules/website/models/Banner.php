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
 * @property integer $subtitle
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
            [['details'], 'string'],
            [['image'], 'file'],
            [['link'], 'url'],
            [['subtitle', 'title'], 'string', 'max' => 255]
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
            'details' => 'Details',
            'image' => 'Image',
            'subtitle' => 'Subtitle'
            ];
    }
}
