<?php
namespace backend\helpers;
use yii\helpers\FileHelper;
use Yii;

/*
	*UploadHelper Class.
    *author: Ahmed Ismail @ensign
*/
class UploadHelper
{
  /**
   *uploads multi images to a model.
   * @param Array $files.
   * @param string $gallery_path.
   * @return json.
   */
	public static function upload($files, $gallery_path)
	{
		$arr = [];
		foreach($files as $one)
		{
			$ext = end((explode(".", $one->name)));
			$rand = Yii::$app->security->generateRandomString();
			$file_name = $rand.".{$ext}";
			$path = Yii::getAlias('@webroot') .'/media/'.$gallery_path.'/gallery/'.$file_name;
			$one->saveAs($path);
			$arr[] = $file_name;
		}
		return json_encode($arr);
	}

	/**
	 *updates multi images to a model.
	 * @param Array $files.
	 * @param string $gallery_path.
	 * @param string $old_files.
	 * @return json.
	 */
	public static function update($files, $gallery_path, $old_files)
	{
		if($old_files != '')
		foreach(json_decode($old_files) as $old)
		{
			if(file_exists(Yii::getAlias('@webroot') .'/media/'.$gallery_path.'/gallery/'.$old))
				unlink(Yii::getAlias('@webroot') .'/media/'.$gallery_path.'/gallery/'.$old);
		}

		$arr = [];
		if(!empty($files))
		foreach($files as $one)
		{
			$ext = end((explode(".", $one->name)));
			$rand = Yii::$app->security->generateRandomString();
			$file_name = $rand.".{$ext}";
			$path = Yii::getAlias('@webroot') .'/media/'.$gallery_path.'/gallery/'.$file_name;
			$one->saveAs($path);
			$arr[] = $file_name;
		}
		return json_encode($arr);
	}
}
?>