<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alr_news".
 *
 * @property integer $id
 * @property string $title
 * @property string $intro
 * @property string $details
 * @property string $image
 * @property string $slug
 * @property string $date_created
 * @property integer $featured
 * @property integer $temp2
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details'], 'string'],
            [['date_created'], 'safe'],
            [['featured', 'temp2'], 'integer'],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
            [['intro'], 'string', 'max' => 555]
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
            'intro' => 'Intro',
            'details' => 'Details',
            'image' => 'Image',
            'slug' => 'Slug',
            'date_created' => 'Date Created',
            'featured' => 'Featured',
            'temp2' => 'Temp2',
        ];
    }
}
