<?php

namespace backend\modules\website\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use common\models\User;
use Yii;

/**
 * This is the model class for table "own_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $details
 * @property string $slug
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 
 */
class Page extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_page';
    }
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'page',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/media/page',
                'url' => Yii::getAlias('@web') . '/media/page',
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
                                        ->thumbnail(new \Imagine\Image\Box(2343, 1063));
                    },
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'details'], 'required'],
            [['details'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
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
            'details' => 'Details',
            'slug' => 'Slug',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }
}
