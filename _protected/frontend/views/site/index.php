<!-- ************** Main slider section************** -->
<section id="slider-section">
    <div class="container-fluid">
        <div class="row" id="last-news">
            <div class="col-xs-4 col-sm-3 col-md-2">
                <h4 class="fl-right">  آخر الأخبار :</h4>
            </div>
            <div class="col-xs-8 col-sm-9 col-md-10 ">
                <marquee direction="right">
                    <?php if(!empty($news)) foreach ($news as $key => $newsItem) {
                        echo $newsItem->intro;
                        if($key < count($news) - 1) echo ' ** ';
                    } ?>
                </marquee>
            </div>
        </div>
    </div>
    <div class="conntainer-fluid">
        <div class="owl-carousel owl-theme" id="slider">
            <?php if(!empty($banners)) foreach ($banners as $banner) { ?>
                <div class="item">
                <figure>
                    <img src="<?= Yii::$app->request->baseUrl ?>/backend/media/banner/<?= $banner->image ?>" class="img-responsive">
                    <figcaption>
                        <h1 class="text-center"><?= $banner->title ?> <br></h1>
                    </figcaption>
                </figure>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ****************Services section**************** -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center section-title">
                <h2>أنشطة الجمعية</h2>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel owl-theme" id="services-slider">
                <?php if(!empty($activities)) foreach ($activities as $activity) { ?>
                <div class="item">
                    <div class="thumbnail">
                        <img src="<?= Yii::$app->request->baseUrl ?>/backend/media/activity/<?= $activity->image ?>" class="img-responsive img-thumbnail">
                        <div class="caption">
                            <h3 class="text-center"><?= $activity->title ?></h3>
                            <p><?= $activity->intro ?></p>
                            <p class="text-left"><a href="<?= Yii::$app->request->baseUrl ?>/activity-<?= $activity->slug ?>" class="btn btn-secondary" role="presentation">التفاصيل</a> </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>
<!--  ****************news **************** -->
<section id="news">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center section-title">
                <h2>أخبار الجمعية</h2>
                <h4 class="text-muted">اخبار الخدمات والأنشطة المختلفة بالجمعية</h4>
            </div>
            <?php if(!empty($news)) { ?>
            <?php $latestNews = $news[0] ?>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?= Yii::$app->request->baseUrl ?>/news-<?= $latestNews->slug ?>"><img src="<?= Yii::$app->request->baseUrl ?>/backend/media/news/<?= $latestNews->image ?>" class="img-responsive img-center img-thumbnail"></a>
                    </div>
                    <div class="col-sm-6  clearfix">
                        <a href="<?= Yii::$app->request->baseUrl ?>/news-<?= $latestNews->slug ?>"><h4><strong><?= $latestNews->title ?></strong></h4></a>
                        <a href="#"><p>تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب تم فتح باب الحجز لعمرة شهر رجب </p></a> 
                     <!-- <a href="#"><p class="text-left"><i class="fa fa-share-alt"></i></p></a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4 id="side-news">آخر الأخبار</h4>
                <ul class="newsticker">
                    <?php foreach ($news as $newsItem) { ?>
                    <li>
                        <a href="<?= Yii::$app->request->baseUrl ?>/news-<?= $newsItem->slug ?>">
                            <div class="row newsticker-item">
                                <div class="col-xs-4 side-news-img">
                                    <img src="<?= Yii::$app->request->baseUrl ?>/backend/media/news/<?= $newsItem->image ?>" class="img-responsive">
                                </div>
                                <div class="col-xs-8">
                                    <p><?= $newsItem->title ?></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-12 text-center" id="all-news">
                <p> <a href="<?= Yii::$app->request->baseUrl ?>/news" class="btn btn-secondary">كافة الأخبار</a></p>
            </div>
            <?php } ?> 
        </div>
    </div>
</section>
<!-- ****************Donate**************** -->
<section id="donate">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center section-title">
                <h2>برامج الرحيم</h2>
            </div>
            <?php if(!empty($programs)) foreach ($programs as $program) { ?>
            <div class="col-md-4 col-sm-6 donate-item">
                <figure>
                    <img src="<?= Yii::$app->request->baseUrl ?>/backend/media/program/<?= $program->image ?>" class="img-responsive">
                    <span class="text-center"><?= $program->title ?></span>
                    <figcaption>
                        <h3 class="text-center"><?= $program->title ?></h3>
                        <p><?= $program->intro ?></p>
                        <ul class="list-inline text-left">
                            <li><a href="donate.html"  type="button" class="btn btn-secondary">التفاصيل</a></li>
                            <li><a href="#donate-ways" class="btn btn-primary">شارك معنا</a></li>
                        </ul>
                    </figcaption>
                </figure>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- **************** Gallery **************** -->
<section id="gallery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center section-title">
                <h2>معرض الصور</h2>
            </div>
        </div>
        <div class="row">
            <div id="filter-gallery" class="text-center">
                <ul class="list-unstyled">
                    <li class="filter active" data-role="button" data-filter="all">عرض الكل</li>
                    <li class="filter" data-role="button" data-filter=".category-1">الدورات الصيفية</li>
                    <li class="filter" data-role="button" data-filter=".category-2">المجمع الخيري</li>
                    <li class="filter" data-role="button" data-filter=".category-3">مساعدة الفقراء</li>
                    <li class="filter" data-role="button" data-filter=".category-4">إفطار الصائم</li>
                    <li class="filter" data-role="button" data-filter=".category-5">توزيع ملابس</li>
                </ul>
            </div>
            <div id="gallery-content">
                <a href="img/10.jpg" data-lightbox="image-1" data-title="My caption" class="mix category-1 all" data-myorder="1"><img src="img/10.jpg" class="img-responsive"></a>
                <a href="img/20.jpg" data-lightbox="image-2" data-title="My caption" class="mix category-2 all" data-myorder="1"><img src="img/20.jpg" class="img-responsive"></a>
                <a href="img/30.jpg" data-lightbox="image-3" data-title="My caption" class="mix category-3 all" data-myorder="1"><img src="img/30.jpg" class="img-responsive"></a>
                <a href="img/40.jpg" data-lightbox="image-4" data-title="My caption" class="mix category-4 all" data-myorder="1"><img src="img/40.jpg" class="img-responsive"></a>
                <a href="img/50.jpg" data-lightbox="image-5" data-title="My caption" class="mix category-5 all" data-myorder="1"><img src="img/50.jpg" class="img-responsive"></a>
                <a href="img/60.jpg" data-lightbox="image-1" data-title="My caption" class="mix category-1 all" data-myorder="1"><img src="img/60.jpg" class="img-responsive"></a>
                <a href="img/70.jpg" data-lightbox="image-2" data-title="My caption" class="mix category-2 all" data-myorder="1"><img src="img/70.jpg" class="img-responsive"></a>
                <a href="img/80.jpg" data-lightbox="image-3" data-title="My caption" class="mix category-3 all" data-myorder="1"><img src="img/80.jpg" class="img-responsive"></a>
                <a href="img/90.jpg" data-lightbox="image-4" data-title="My caption" class="mix category-4 all" data-myorder="1"><img src="img/90.jpg" class="img-responsive"></a>
                <a href="img/11.jpg" data-lightbox="image-1" data-title="My caption" class="mix category-1 all" data-myorder="1"><img src="img/11.jpg" class="img-responsive"></a>
                <a href="img/21.jpg" data-lightbox="image-2" data-title="My caption" class="mix category-2 all" data-myorder="1"><img src="img/21.jpg" class="img-responsive"></a>
                <a href="img/32.jpg" data-lightbox="image-3" data-title="My caption" class="mix category-3 all" data-myorder="1"><img src="img/32.jpg" class="img-responsive"></a>
                <a href="img/42.jpg" data-lightbox="image-4" data-title="My caption" class="mix category-4 all" data-myorder="1"><img src="img/42.jpg" class="img-responsive"></a>
                <a href="img/52.jpg" data-lightbox="image-5" data-title="My caption" class="mix category-5 all" data-myorder="1"><img src="img/52.jpg" class="img-responsive"></a>
                <a href="img/62.jpg" data-lightbox="image-1" data-title="My caption" class="mix category-1 all" data-myorder="1"><img src="img/62.jpg" class="img-responsive"></a>
                <a href="img/72.jpg" data-lightbox="image-2" data-title="My caption" class="mix category-2 all" data-myorder="1"><img src="img/72.jpg" class="img-responsive"></a>
            </div>
        </div>
    </div>
</section>      
<!-- *************** Donate Ways ************* -->
<section id="donate-ways">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center sectio-title">
                <h2>طرق التبرع</h2>
                <h4 class="text-muted">يمكنك التبرع بأحد الطرق الآتية</h4>
            </div>
        </div>
        <div class="row">
            <div id="donate-ways-slider" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="donate-way" id="sign-up">
                        <h4 class="text-muted text-center">اشترك في الجمعية</h4>
                        <p class="text-justify">اشترك معنا في جمعية الرحيم الخيرية وساهم في كفالة طفل يتيم أو مساعدة محتاج أو معالجة مريض وذلك عن طريق اشتراك رمزي شهري لن يؤثر على ميزانيتك لكنه سيسعد محتاج</p>
                        <p><a class="btn btn-primary btn-lg center-block" href="#member" data-toggle="modal">اشترك الآن</a></p>
                    </div>
                </div>
                <div class="item">
                    <div class="donate-way" id="bank">
                        <span><i class="fa fa-bank"></i></span>
                        <h4 class="text-muted">يمكنك التبرع في بنك فيصل الاسلامي فرع الجيزة في حساب رقم 12312</h4>
                    </div>
                </div>
                <div class="item">
                    <div class="donate-way" id="call-us">
                        <h4 class="text-muted">اتصل على أحد الآرقام التالية ليصلك مندوبنا لباب المنزل</h4>
                        <ul>
                            <li><i class="fa fa-phone-square"></i> 01111000876</li>
                            <li><i class="fa fa-phone-square"></i> 01000087678</li>
                            <li><i class="fa fa-phone-square"></i> 02236570887</li>
                        </ul>
                    </div>
                </div>
                <div class="item">
                    <div class="donate-way page-scroll" id="visit-us">
                        <h4 class="text-muted">يمكنك زيارة مقر الجمعية على العنوان التالي</h4>
                        <p>مسجد الرحيم - كرداسه -بجوار الدائري- الجيزة</p>
                        <a href="#map"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="donate-way" id="your-phone">
                        <h4 class="text-muted">اترك رقم هاتفك وسيقوم مندوبنا بالاتصال بك</h4>
                        <input type="phone" class="form-control" placeholder="رقم الهاتف"></input>
                        <button type="supmit" class="btn btn-secondary">إرسال</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12" id="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1026.7963596684513!2d31.174798651359755!3d30.04496117066919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1471219169968" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<!-- *************** contact us ************** -->
<section id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center section-title">
                <h2>اتصل بنا</h2>
                <h4 class="text-muted">اترك رسالتك وسيتم الرد عليك في أقرب وقت</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form name="send-message" id="contact-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="name" placeholder="اكتب اسمك" class="form-control" id="name"></input>
                            </div>
                            <div class="form-group">
                                <input type="Email" placeholder="البريد الإلكتروني" class="form-control" id="email"></input>
                            </div>
                            <div class="form-group">
                                <input type="phone" placeholder="رقم التليفون" class="form-control" id="phone"></input>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="اترك رسالتك" rows="6" id="message"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>