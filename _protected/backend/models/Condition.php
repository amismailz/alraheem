<?php

namespace backend\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use backend\models\Delivery;
use Yii;

/**
 * This is the model class for table "alr_condition".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property integer $type_id
 * @property integer $zone_id
 * @property integer $aid_type_id
 * @property integer $cid
 * @property string $husband_name
 * @property integer $husband_cid
 * @property string $research_num
 * @property integer $num_person
 * @property string $photo
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property ConditionType $type
 * @property Zone $zone
 * @property AidType $aidType
 * @property User $createdBy
 * @property User $updatedBy
 * @property Delivery[] $deliveries
 * @property File[] $files
 */
class Condition extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                //'createdAtAttribute' => 'create_time',
                //'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ], 
            BlameableBehavior::className(),
            
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'condition',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/media/condition',
                'url' => Yii::getAlias('@web') . '/media/condition',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(70, 70));
                    },
                    'medium' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(263, 262));
                    },
                ]
            ]
       
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alr_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'cid', 'phone', 'mobile', 'research_num', 'husband_cid'], 'unique'],
            [['cid', 'husband_cid'], 'integer'],
            [['type_id', 'zone_id', 'aid_type_id', 'num_person', 'created_by', 'updated_by'], 'integer'],
            [['notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'phone', 'mobile', 'husband_name', 'research_num', 'photo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'type_id' => Yii::t('app', 'Type'),
            'zone_id' => Yii::t('app', 'Zone'),
            'aid_type_id' => Yii::t('app', 'Aid Type'),
            'cid' => Yii::t('app', 'Cid'),
            'husband_name' => Yii::t('app', 'Husband Name'),
            'husband_cid' => Yii::t('app', 'Husband Cid'),
            'research_num' => Yii::t('app', 'Research Num'),
            'num_person' => Yii::t('app', 'Num Person'),
            'notes' => Yii::t('app', 'Notes'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ConditionType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZone()
    {
        return $this->hasOne(Zone::className(), ['id' => 'zone_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAidType()
    {
        return $this->hasOne(AidType::className(), ['id' => 'aid_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['case_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['cond_id' => 'id']);
    }
    
    public function checkAid($aid_id)
    {
        return Delivery::find()->where(['condition_id'=>$this->id, 'aid_id'=>$aid_id])->one();
    }
}
