<?php

namespace backend\modules\website\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $intro
 * @property string $details
 * @property string $image
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $featured
 */
class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{web_news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['details'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['featured'], 'integer'],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
            [['intro'], 'string', 'max' => 555]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'intro' => 'Intro',
            'details' => 'Details',
            'image' => 'Image',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'created_at' => 'Updated At',
            'featured' => 'Featured'
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => TimestampBehavior::className(),
                //'createdAtAttribute' => 'create_time',
                //'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className(),
        ];
    }

}
