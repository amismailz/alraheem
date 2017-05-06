<?php

namespace backend\modules\website\models;
use zxbodya\yii2\galleryManager\GalleryBehavior;

use Yii;

/**
 * This is the model class for table "own_activity".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $gallery_id
 * @property integer $sort
 */
class Activity extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'activity',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/media/activity',
                'url' => Yii::getAlias('@web') . '/media/activity',
                'hasName'=>false,
                'hasDescription'=>false,
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
            [['gallery_id', 'sort'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'gallery_id' => 'Gallery ID',
            'sort' => 'Sort',
        ];
    }
    
    public function getMedium() {
        $images = $this->getBehavior('galleryBehavior')->getImages();
        $first = reset($images);
        if ($first)
            return Yii::$app->request->baseUrl . '/backend/media/activity/' . $this->id.'/'.$first->rank.'/medium.jpg';
        return '';
    }

}
