<?php
namespace backend\helpers;

use Yii;
/**
 * -----------------------------------------------------------------------------
 * CssHelper class.
 * -----------------------------------------------------------------------------
 */
class CssHelper
{
    /**
     * =========================================================================
     * Returns the appropriate css class based on the value of user $status.
     * NOTE: used in user/index view.
     * =========================================================================
     *
     * @param  string  $status  User status.
     *
     * @return string           Css class.
     * _________________________________________________________________________
     */
    public static function statusCss($status)
    {
        if ($status === 'Active')
        {
            return "boolean-true";
        }
        else
        {
            return "boolean-false";
        }
    }

    /**
     * =========================================================================
     * Returns the appropriate css class based on the value of role $item_name.
     * NOTE: used in user/index view.
     * =========================================================================
     *
     * @param  string  $role  Role name.
     *
     * @return string         Css class.
     * _________________________________________________________________________
     */
    public static function roleCss($role)
    {
        if ($role === "The Creator")
        {
            return "role-the-creator";
        }
        elseif ($role === "admin")
        {
            return "role-admin";
        }
        elseif($role === "premium")
        {
            return "role-premium-member";
        }
        else
        {
            return "role-member";
        }
    }

    /**
     * =========================================================================
     * Returns the appropriate css class based on the value of setting $value.
     * NOTE: used in setting/index view.
     * =========================================================================
     *
     * @param  string  $value  Setting value.
     *
     * @return string          Css class.
     * _________________________________________________________________________
     */
    public static function settingValueCss($value)
    {
        if ($value === "Yes")
        {
            return "boolean-true";
        }
        else
        {
            return "boolean-false";
        }
    }

	/* My own helper methods (Ahmed Ismail) */
	public static $arabic_dayes = array(
										'Sat'=>'�����',
										'Sun'=>'�����',
										'Mon'=>'�������',
										'Tue'=>'��������',
										'Wed'=>'��������',
										'Thu'=>'������',
										'Fri'=>'������'
										);
	public static function getPageUrl($id)
	{
		$page = Page::model()->findByPk($id);
		return $page->url;
	}

	public static function activate($action)
	{

		if($action ==  Yii::$app->controller->action->id)
		{

			return 'active';

		}

		return "";
	}
	public static function adminActivate($controller)
	{

		if(Yii::$app->controller->id == $controller)
		{
			return 'active';
		}

		return "";
	}

	public static function slugify($str)
	{
		$slug = preg_replace('@[\s!:;_\?=\\\+\*/%&#]+@', '-', $str);
		//this will replace all non alphanumeric char with '-'
		$slug = mb_strtolower($slug);
		//convert string to lowercase
		$slug = trim($slug, '-');
		//trim whitespaces
		return $slug;
	}

	public static function galleryPhotos($gallery_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'gallery_id=:id';
		$criteria->params = array(':id' => $gallery_id);
		$photos = GalleryPhoto::model()->findAll($criteria);
		$srcs = array();
		foreach($photos as $photo)
		{
			$srcs[] = Yii::app()->request->baseUrl.'/gallery/'.$photo->rank;
		}

		return $srcs;
	}

	public static function gallerySmallPhotos($gallery_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'gallery_id=:id';
		$criteria->params = array(':id' => $gallery_id);
		$photos = GalleryPhoto::model()->findAll($criteria);
		$srcs = array();
		foreach($photos as $photo)
		{
			$srcs[] = Yii::app()->getBaseUrl(true).'/gallery/'.$photo->rank.'small';
		}

		return $srcs;
	}

	public static function galleryMediumPhotos($gallery_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'gallery_id=:id';
		$criteria->params = array(':id' => $gallery_id);
		$photos = GalleryPhoto::model()->findAll($criteria);
		$srcs = array();
		foreach($photos as $photo)
		{
			$srcs[] = Yii::app()->getBaseUrl(true).'/gallery/'.$photo->rank.'medium';
		}

		return $srcs;
	}

	public static function updateVisits($id)
	{
		$product = Product::model()->findByPk($id);
		$product->visits++;
		$product->save();
	}

	public static function encrypt($text)
	{  $salt = 'ensign';
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}

	public static function decrypt($text)
	{
		$salt = 'ensign';
		/* @var $salt type */
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}
        
        public static function activateActions($controller, array $actions)
        {
            if(Yii::$app->controller->id == $controller && in_array(Yii::$app->controller->action->id, $actions))
                    return 'active';
                return '';
        }
}