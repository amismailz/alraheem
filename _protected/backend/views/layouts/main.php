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
    <title>Alraheem | Control Panel | <?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
    <?php $this->head() ?>
  </head>
  <body class="skin-blue sidebar-mini sidebar-collapse">
      <?php $this->beginBody() ?>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('') ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Alraheem</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Alraheem</b>Admin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top <?php if(Yii::$app->params['sidebar'] == 'fullScreen') echo 'margin-50' ?>" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                <a href="<?= Yii::$app->request->baseUrl ?>/../" target="_blank"><i class="fa fa-external-link"></i>Front End</a>
              </li>
            <?php if(!Yii::$app->user->isGuest){ ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                  <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?= Yii::$app->user->identity->username ?>
                  </li>
                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?= Html::a('Profile', ['user/update', 'id'=>Yii::$app->user->identity->id], ['class'=>'btn btn-default btn-flat', 'data-method'=>'post']) ?>
                    </div>
                    <div class="pull-right">
                      <?= Html::a('Sign out', ['site/logout'], ['class'=>'btn btn-default btn-flat', 'data-method'=>'post']) ?>
                    </div>
                  </li>
                </ul>
              </li>
              <?php } ?>
                            
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
     <?php
      if (Yii::$app->user->can('Delivery')) {
          $this->beginContent('@app/views/layouts/adminPanel.php');
          $this->endContent();
      }
      ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="<?php if(Yii::$app->params['sidebar'] == 'fullScreen') echo 'margin-50' ?>">
            <?= Html::encode($this->title) ?>
          </h1>
          <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        </section>

        <!-- Main content -->
        <section class="content <?php if(Yii::$app->params['sidebar'] == 'fullScreen') echo 'margin-50' ?>">
          <div class="box">
                <div class="box-body">
                    <?= $content ?>
                </div>
            </div>     
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.alraheem.net">Alraheem</a>.</strong> All rights reserved.
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

   
    <?php $this->endBody() ?>
<!--     Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>-->
  
  </body>
</html>
<?php $this->endPage() ?>
