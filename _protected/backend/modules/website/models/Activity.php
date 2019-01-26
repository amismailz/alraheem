<?php

namespace backend\modules\website\models;

use zxbodya\yii2\galleryManager\GalleryBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "own_activity".
 *
 * @property integer $id
 * @property string $title
 * @property string $intro
 * @property string $details
 * @property string $image
 * @property string $sort
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Activity extends \yii\db\ActiveRecord {

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
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'activity',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/media/activity',
                'url' => Yii::getAlias('@web') . '/media/activity',
                'hasName' => false,
                'hasDescription' => false,
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(1024, 683));
                    },
                    'medium' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(2048, 1366));
                    },
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'web_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['gallery_id', 'sort', 'created_by', 'updated_by'], 'integer'],
            [['intro'], 'string', 'max' => 555],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            [['details'], 'string']
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
            'gallery_id' => 'Gallery ID',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'created_at' => 'Updated At',
        ];
    }

    public function getMedium() {
        $images = $this->getBehavior('galleryBehavior')->getImages();
        $first = reset($images);
        if ($first)
            return Yii::$app->request->baseUrl . '/backend/media/activity/' . $this->id . '/' . $first->rank . '/medium.jpg';
        return '';
    }

}
