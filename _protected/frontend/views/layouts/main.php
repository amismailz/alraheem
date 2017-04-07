<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= Html::encode($this->title) ?></title>

    <!-- Bootstrap -->
    <link href="<?= Yii::$app->request->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/ticker-style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/lightbox.css">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link href="<?= Yii::$app->request->baseUrl ?>/css/layer.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
  </head>
  <body>
      <?php $this->beginBody() ?>
    <!-- ************ Header ************ -->
    <header>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="page-scroll navbar-header">
                <button type="button" class="navbar-toggle" id="nav-collapse111" data-toggle="collapse" data-target="#bs-example-navbar-collapse-111" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><img src="img/logo.png" class="img-responsive"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse clearfix in" id="bs-example-navbar-collapse-111">
                <ul class="nav navbar-nav navbar-right">
                  <li role="presentation"  class="active"><a href="index.html">الرئيسية</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">عن الجمعية <span class="caret fl-left"></span></a>
                    <ul class="dropdown-menu dropdown-inside"  class="nav nav-tabs" role="tablist">
                      <li><a href="who.html #who">من نحن</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="who.html #mission">الرؤية والرسالة</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="who.html #success">الإنجازات</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#services"  class="page-scroll">أنشطة الجمعية </a>
                  </li>
                  <li> <a href="#donate" class="page-scroll">برامج الرحيم</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">المركز الإعلامي<span class="caret fl-left"></span></a>
                    <ul class="dropdown-menu dropdown-inside">
                      <li><a href="#news">أخبار الجمعية</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#gallery">مكتبة الصور</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#donate-ways">طرق التبرع</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">مكتبة الفيديو</a></li>
                    </ul>
                  </li>
                  <li><a href="#contact-us">اتصل بنا</a></li>
                  <li><a id="facebook" class="ficon" href="https://www.facebook.com/elraheem1"><i class="fa fa-facebook"></i></a><a id="twitter" class="ficon" href="#"><i class="fa fa-twitter"></i></a><a id="google-plus" class="ficon" href="#"><i class="fa fa-google-plus"></i></a><a id="youtube" class="ficon" href="#"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
        </div>
        <!-- /.container -->
      </nav>      
    </header>
    <?= $content ?>
    <!-- *************** fast links ************** -->
    <section id="fast-links">
       <div class="container">
           <div class="row">
               <div class="col-md-4 col-xs-12">
                   <h3 class="links">روابط سريعة</h3>
                   <div class="row">
                     <ul class="fl-right col-sm-6">
                         <li><a href="#">الرئيسية</a></li>
                         <li><a href="who.html #who">عن الجمعية</a></li>
                         <li><a href="services.html">أنشطة الجمعية</a></li>
                         <li><a href="who.html #success">الانجازات</a></li>
                         <li><a href="#donate-ways">طرق التبرع</a></li>
                         <li><a href="#contact-us">اتصل بنا</a></li>
                     </ul>
                     <ul class="fl-right col-sm-6">
                         <li><a href="#gallery">معرض الصور</a></li>
                         <li><a href="#news">أخر الأخبار</a></li>
                         <li><a href="#">مركز غسيل الكلى</a></li>
                         <li><a href="services.html">أنشطة الجمعية</a></li>
                         <li><a href="#">أنشطة الجمعية</a></li>
                         <li><a href="#donate-ways">طرق التبرع</a></li>
                     </ul>
                    </div>
               </div>
               <div class="col-md-4 col-xs-12">
                <div  id="email-form">
                  <p>اشترك في القائمة البريدية ليصلك كل جديد</p>
                  <form>
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="اكتب بريدك الإلكتروني">
                    </div>
                    <p class="text-left"><button type="submit" class="btn btn-default">إرسال</button></p>
                  </form>
                </div>
               </div>
               <div class="col-md-4 col-xs-12">
                <h3>صفحتنا على فيسبوك</h3>
                 <div class="fb-page"
                  data-href="https://www.facebook.com/elraheem1" 
                  data-width="340"
                  data-hide-cover="false"
                  data-show-facepile="true"></div>
               </div>
           </div>
       </div>
    </section>                                     

    <!-- *************** footer ************** -->
    <footer>
     <div class="container">
       <div class="row">
         <p class="text-center"> &copy; 2016 جميع الحقوق محفوظة لجمعية الرحيم الخيرية</p>
       </div>
     </div>
    </footer>     
       
     
      
    <!-- Modals -->
    <!-- member modal -->
    <div class="modal fade my-modal" id="member" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h3>اشترك في الجمعية</h3>
                            <div class="row">
                              <form class="form-horizontal">
                                <div class="form-group">
                                  <label for="exampleInputName2"  class="col-sm-3 control-label fl-right">الأسم</label>
                                   <div class="col-sm-9">
                                      <input type="text" class="form-control" id="exampleInputName2" placeholder="الاسم">
                                   </div>
                                  </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-3 control-label">البريد الإلكتروني</label>
                                  <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="البريد الإلكتروني">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputtelephone" class="col-sm-3 control-label">الهاتف المحمول</label>
                                  <div class="col-sm-9">
                                    <input type="telephone" class="form-control" id="inputEmail3" placeholder="رقم التليفون">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputtelephone" class="col-sm-3 control-label">نوع الاشتراك</label>
                                  <div class="col-sm-9">
                                    <select class="form-control">
                                      <option>اشتراك شهري</option>
                                      <option>اشتراك ربع سنوي</option>
                                      <option>اشتراك نصف سنوي</option>
                                      <option>اشتراك سنوي</option>
                                    </select>
                                  </div>
                                 </div>
                                 <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">إرسال</button>
                                  </div>
                                </div>
                             </form>
                            </div>
                            <button type="button" class="btn btn-default fl-left" data-dismiss="modal"><i class="fa fa-times"></i> إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery-2.2.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= Yii::$app->request->baseUrl ?>/js/bootstrap.min.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/cbpAnimatedHeader.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/classie.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/owl.carousel.min.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.mousewheel-3.0.6.pack.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.newsTicker.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/lightbox.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.mixitup.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.fancybox.pack.js"></script>
    <script src="//connect.facebook.net/ru_RU/sdk.js#xfbml=1&amp;version=v2.5"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/script.js"></script>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
