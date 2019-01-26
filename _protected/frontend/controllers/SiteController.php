<?php

namespace frontend\controllers;

use common\models\User;
use common\models\LoginForm;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Member;
use backend\models\MemberPayment;
use yii\web\NotFoundHttpException;
use Yii;

use backend\modules\website\models\News;
use backend\modules\website\models\Activity;
use backend\modules\website\models\Program;
use backend\modules\website\models\Banner;
use backend\modules\website\models\Page;

require('Unifonic/Autoload.php');

use \Unifonic\API\Client;

/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class SiteController extends Controller {

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'send-sms'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex() {
        $about = Page::findOne(1);
        $banners = Banner::find()->all();
        $news = News::find()->orderBy('created_at')->all();
        $activities = Activity::find()->orderBy('sort')->all();
        $programs = Program::find()->all();
        return $this->render('index', [
            'about' => $about,
            'banners' => $banners,
            'news' => $news,
            'activities' => $activities,
            'programs' => $programs,
        ]);
    }

    public function actionPaymentSms($id = null, $limit = 20) {
        $members = $id ? 
                [ Member::findOne($id) ] :
            Member::find()
                ->where('CHAR_LENGTH(phone) = 11')
                ->andWhere('last_payment IS NULL OR last_payment != "' . date('Y-m').'"'  )
                ->limit($limit)
                ->all();
        $response = [];
        if (!empty($members))
            foreach ($members as $member) {
                $response[] = self::sendMemberPaymentSms($member);
            }
        echo count($response);
        var_dump($response);
    }
    
//    public function actionSendSms($id = null) {
//        if($id){
//            $response = self::sendMemberSms(Member::findOne($id));
//        } else {
//            $response = self::sendInRecursion();
//        }
//        var_dump($response);
//    }
    
//    public static function sendInRecursion() {
//        $response = [];
//        $notPayedMember = Member::find()->where([ 'last_payment' => null ])->orWhere([ '!=', 'last_payment', date('Y-m') ])->one();
//            if($notPayedMember) {
//                $response[] = self::sendMemberSms($notPayedMember);
//                $notPayedMember->last_payment = date('Y-m');
//                $notPayedMember->save();
//                self::sendInRecursion();
//            } else{
//                return $response;
//            }        
//    }

    public static function sendMemberPaymentSms($member) {
        // Save last payment
        $member->last_payment =  date('Y-m');
        $member->save(false);
        // Begin list from last payment year. If no payment at all, begin from current year
        $lastPayment = MemberPayment::find()->where(['member_id' => $member->id])->orderBy('year DESC')->one();
        $firstYear = 2019; // As per client request, its asked to send SMS starting 2019 // $lastPayment ? $lastPayment->year : date('Y');
        $lastYear = intval(date('Y'));
        $notPayedMonths = [];
        for ($y = $firstYear; $y <= $lastYear; $y++) {
            for ($m = 1; $m <= ($y == $lastYear ? date('m') : 12); $m++) {
                ////$payment = $member->isPayed($m, $y);
                if (!$member->isPayed($m, $y))
                    $notPayedMonths[] = $m;
            }
        }
        if (!empty($notPayedMonths)) {
            // reverse array to be rtl for arabic
            $rtlArray = array_reverse($notPayedMonths);
            // @todo adjust array length to not exceed sms limit
            $text = 'نذكركم بالاشتراك الشهري عن شهر ' . implode(',', array_slice($rtlArray, 0, 7));
            $client = new Client();
            return self::sendSms($text, $member->phone);
        }
    }
    
    
    public function actionSendThanksSms($id = null, $limit = 20) {
        $members = $id ? 
                [ Member::findOne($id)] :
            Member::find()
                ->where('CHAR_LENGTH(`phone`) = 11')
                ->andWhere('(last_thanks_sms IS NULL) OR (last_thanks_sms != "' . date('Y-m') .'")'  )
                ->limit($limit)
                ->all();
        $response = [];
        $text = ' نشكركم لمساهمتكم في رعاية الايتام والمرضى لعام 2018';
        if (!empty($members))
            foreach ($members as $member) {
                    $response[] = self::sendSms($text, $member->phone);
                    // Save last action
                    $member->last_thanks_sms =  date('Y-m');
                    $member->save(false);
            }
        echo count($response);
        var_dump($response);
    }
    
    public function actionMembershipSms($id = null, $limit = 20) {
        $members = $id ? 
                [ Member::findOne($id)] :
            Member::find()
                ->where('CHAR_LENGTH(`phone`) = 11')
                ->andWhere('(last_membership_sms IS NULL) OR (last_membership_sms != "' . date('Y-m') .'")'  )
                ->limit($limit)
                ->all();
        $response = [];
        if (!empty($members))
            foreach ($members as $member) {
                    $text = "رقم عضويتك هو ($member->id) برجاء ابلاغه لمستلم الاشتراك للأهمية";
                    $response[] = self::sendSms($text, $member->phone);
                    // Save last action
                    $member->last_membership_sms =  date('Y-m');
                    $member->save(false);
            }
        echo count($response);
        var_dump($response);
    }

    /**
     * 
     * @param type $text message content
     * @param type $phone_number the receiver phone number
     * @return array response from unifonic api
     */
    public static function sendSms($text, $phone_number) {
        $client = new Client();
        return $client->Messages->Send(intval("2$phone_number"), $text, "Elraheem"); // send regular massage
    }


    /**
     * Displays the about static page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Displays the contact static page and sends the contact email.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact() {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

//------------------------------------------------------------------------------------------------//
// LOG IN / LOG OUT / PASSWORD RESET
//------------------------------------------------------------------------------------------------//

    /**
     * Logs in the user if his account is activated,
     * if not, displays appropriate message.
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // now we can try to log in the user
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        // user couldn't be logged in, because he has not activated his account
        elseif ($model->notActivated()) {
            // if his account is not activated, he will have to activate it first
            Yii::$app->session->setFlash('error', 'You have to activate your account first. Please check your email.');

            return $this->refresh();
        }
        // account is activated, but some other errors have happened
        else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the user.
     *
     * @return \yii\web\Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /* ----------------*
     * PASSWORD RESET *
     * ---------------- */

    /**
     * Sends email that contains link for password reset action.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        } else {
            return $this->render('requestPasswordResetToken', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Resets password.
     *
     * @param  string $token Password reset token.
     * @return string|\yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        } else {
            return $this->render('resetPassword', [
                        'model' => $model,
            ]);
        }
    }

//------------------------------------------------------------------------------------------------//
// SIGN UP / ACCOUNT ACTIVATION
//------------------------------------------------------------------------------------------------//

    /**
     * Signs up the user.
     * If user need to activate his account via email, we will display him
     * message with instructions and send him account activation email
     * ( with link containing account activation token ). If activation is not
     * necessary, we will log him in right after sign up process is complete.
     * NOTE: You can decide whether or not activation is necessary,
     * @see config/params.php
     *
     * @return string|\yii\web\Response
     */
    public function actionSignup() {
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();

        // collect and validate user data
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // try to save user data in database
            if ($user = $model->signup()) {
                // if user is active he will be logged in automatically ( this will be first user )
                if ($user->status === User::STATUS_ACTIVE) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
                // activation is needed, use signupWithActivation()
                else {
                    $this->signupWithActivation($model, $user);

                    return $this->refresh();
                }
            }
            // user could not be saved in database
            else {
                // display error message to user
                Yii::$app->session->setFlash('error', "We couldn't sign you up, please contact us.");

                // log this error, so we can debug possible problem easier.
                Yii::error('Signup failed! 
                    User ' . Html::encode($user->username) . ' could not sign up.
                    Possible causes: something strange happened while saving user in database.');

                return $this->refresh();
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Sign up user with activation.
     * User will have to activate his account using activation link that we will
     * send him via email.
     *
     * @param $model
     * @param $user
     */
    private function signupWithActivation($model, $user) {
        // try to send account activation email
        if ($model->sendAccountActivationEmail($user)) {
            Yii::$app->session->setFlash('success', 'Hello ' . Html::encode($user->username) . '. 
                To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.');
        }
        // email could not be sent
        else {
            // display error message to user
            Yii::$app->session->setFlash('error', "We couldn't send you account activation email, please contact us.");

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed! 
                User ' . Html::encode($user->username) . ' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }

    /* --------------------*
     * ACCOUNT ACTIVATION *
     * -------------------- */

    /**
     * Activates the user account so he can log in into system.
     *
     * @param  string $token
     * @return \yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionActivateAccount($token) {
        try {
            $user = new AccountActivation($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()) {
            Yii::$app->getSession()->setFlash('success', 'Success! You can now log in. 
                Thank you ' . Html::encode($user->username) . ' for joining us!');
        } else {
            Yii::$app->getSession()->setFlash('error', '' . Html::encode($user->username) . ' your account could not be activated, 
                please contact us!');
        }

        return $this->redirect('login');
    }

}
