<?php
use backend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title>طباعة الكارنيهات</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
  </head>
  <body class="skin-blue sidebar-mini <?php if(Yii::$app->params['sidebar'] == 'fullScreen') echo 'sidebar-collapse' ?>">
      <?php $this->beginBody() ?>

      <?= $content ?>
      <?php $this->endBody() ?>
<!--     Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>-->
  
  </body>
</html>
<?php $this->endPage() ?>
