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
        <!-- Sidebar user panel -->
        <!--          <div class="user-panel">
                    <div class="pull-left image">
                      <i class="fa fa-user"></i>
                    </div>
                    <div class="pull-left info">
                      <p><?= Yii::$app->user->identity->username ?></p>
                    </div>
                  </div>-->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo CssHelper::adminActivate('site'); ?> treeview">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('') ?>">
                    <i class="fa fa-dashboard"></i> <span><?= Yii::t('app', 'Dashboard') ?></span>
                </a>

            </li>

            <li class="<?php echo CssHelper::adminActivate('condition'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('condition') ?>">
                    <i class="fa fa-image"></i> <span><?= Yii::t('app', 'Conditions') ?></span> <small class="label pull-left bg-green"><?= Condition::find()->count() ?></small>
                </a>
            </li>
            <li class="<?php echo CssHelper::activateActions('condition', ['create']); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('condition/create') ?>">
                    <i class="fa fa-plus"></i> <span><?= Yii::t('app', 'Add Condition') ?></span> <small class="label pull-left bg-green"></small>
                </a>
            </li>
            <li class="<?php echo CssHelper::adminActivate('aid'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('aid') ?>">
                    <i class="fa fa-cubes"></i> <span><?= Yii::t('app', 'Aids') ?></span> <small class="label pull-left bg-green"></small>
                </a>
            </li>
            <li class="treeview <?php echo CssHelper::adminActivate('zone'); ?><?php echo CssHelper::adminActivate('condition-type'); ?><?php echo CssHelper::adminActivate('aid-type'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span><?= Yii::t('app', 'Classifications') ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo CssHelper::adminActivate('zone'); ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('zone') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Condition Zones') ?></a></li>
                    <li class="<?php echo CssHelper::adminActivate('condition-type'); ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('condition-type') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Condition Types') ?></a></li>
                    <li class="<?php echo CssHelper::adminActivate('aid-type'); ?>"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('aid-type') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'Aid Types') ?></a></li>

                </ul>
            </li>
            <li class="treeview <?php echo CssHelper::adminActivate('member-job'); ?><?php echo CssHelper::adminActivate('member'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span><?= Yii::t('app', 'قسم الاعضاء') ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo CssHelper::adminActivate('member'); ?>">
                        <small class="label pull-left bg-green"><?= \backend\models\Member::find()->count() ?></small>
                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('member') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'الاعضاء') ?></a>
                        
                    </li>
                    <li class="<?php echo CssHelper::adminActivate('member-job'); ?>">
                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('member-job') ?>"><i class="fa fa-circle-o"></i> <?= Yii::t('app', 'الوظائف') ?></a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo CssHelper::adminActivate('user'); ?>">
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('user') ?>">
                    <i class="fa fa-users"></i> <span><?= Yii::t('app', 'Users') ?></span> <small class="label pull-right bg-green"></small>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
