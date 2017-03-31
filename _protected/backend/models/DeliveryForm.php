<?php
namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * DeliveryForm is the model behind the login form.
 */
class DeliveryForm extends Model
{
    public $aid_id;
    public $condition_id;

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['aid_id', 'condition_id'], 'required'],
            [['aid_id', 'condition_id'], 'integer']
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'aid_id' => 'المساعدة',
            'condition_id' => 'رقم الحالة'
        ];
    }
}
