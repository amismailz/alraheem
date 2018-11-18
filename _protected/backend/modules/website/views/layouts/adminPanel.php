<?php

use backend\helpers\CssHelper;
use backend\models\Condition;
use backend\models\ConditionType;
use backend\models\Zone;
use backend\models\Aid;
use backend\models\AidType;
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo CssHelper::adminActivate('page'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['website/page/update', 'id'=>1]) ?>">
                    <i class="fa fa-list-ol"></i> <span><?= Yii::t('app', 'عن الجمعية') ?></span>
                </a>
            </li>
            <li class="<?php echo CssHelper::adminActivate('banner'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('website/banner') ?>">
                    <i class="fa fa-image"></i> <span><?= Yii::t('app', 'اللافتات') ?></span> <small class="label pull-left bg-green"><?= backend\modules\website\models\Banner::find()->count() ?></small>
                </a>
            </li>
            <li class="<?php echo CssHelper::adminActivate('news'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('website/news') ?>">
                    <i class="fa fa-image"></i> <span><?= Yii::t('app', 'الاخبار') ?></span> <small class="label pull-left bg-green"><?= backend\modules\website\models\News::find()->count() ?></small>
                </a>
            </li>
            <li class="<?php echo CssHelper::adminActivate('activity'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('website/activity') ?>">
                    <i class="fa fa-image"></i> <span><?= Yii::t('app', 'انشطة الجمعية') ?></span> <small class="label pull-left bg-green"><?= backend\modules\website\models\Activity::find()->count() ?></small>
                </a>
            </li>
            <li class="<?php echo CssHelper::adminActivate('program'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('website/program') ?>">
                    <i class="fa fa-image"></i> <span><?= Yii::t('app', 'برامج الرحيم') ?></span> <small class="label pull-left bg-green"><?= backend\modules\website\models\Program::find()->count() ?></small>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
