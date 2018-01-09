<?php

namespace app\controllers;

use app\components\payment\KkbPayment;
use app\models\Lang;
use app\models\School;
use app\models\Test;
use app\models\TestName;
use app\models\TestQuestion;
use app\models\TestResult;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * @inheritdoc
     */
    public function actions()
    {
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

    public function actionIndex()
    {
        $langs = Lang::find()->all();
        $school = new School();
        if ($school->load(Yii::$app->request->post())) {
            $school->amount = 25000;
            $school->generateKey();
            $school->save();
            $sign = KkbPayment::process_request($school->id, '398', $school->amount, \Yii::getAlias('@app') . '/paysys/config.txt');
            $this->redirect(['confirm-school', 'id' => $school->id, 'sign' => $sign]);
        }
        return $this->renderPartial('index', ['langs' => $langs, 'school' => $school]);
    }

    public function actionConfirmSchool($id, $sign)
    {
        return $this->renderPartial('confirm-school', ['id' => $id, 'sign' => $sign]);
    }

    public function actionTest($symbol = null)
    {
        if(null !== $symbol) {
            $testResult = TestResult::find()->where(['test_id' => 1, 'code' => $symbol])->one();
            $image = '/img/avatars/' . $symbol . '.jpg';
            $title = $testResult->translate ?  $testResult->translate->name : '';
            $description = $testResult->translate ?  $testResult->translate->description : '';
        } else {
            $image = '/img/header.jpg';
            $title = Yii::t('app', 'FIND YOUR CALL');
            $description = Yii::t('app', 'The test was developed by a group of psychologists to determine your vocation.');
        }
        return $this->renderPartial('test', [
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function actionTestData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lang = Lang::getCurrent();
        $data = [];

        $tests = Test::find()->all();

        foreach ($tests as $test) {
            $testName = TestName::find()->where(['lang_id' => $lang->id, 'test_id' => $test->id])->one();
            if($testName) {
                $item = [
                    'title' => $testName->title,
                    'subtitle' => $testName->subtitle,
                    'description' => $testName->description,
                ];
            } else {
                $item = [
                    'title' => '',
                    'subtitle' => '',
                    'description' => '',
                ];
            }

            foreach ($test->questions as $question) {
                $item['questions'][] = $question->translate ? $question->translate->question : '';
                $item['answers'][] = ['first' => $question->translate ? $question->translate->answer_first : '', 'second' => $question->translate ? $question->translate->answer_second : ''];
            }

            if($test->id === 1) {
                foreach ($test->results as $result) {
                    $item['results'][$result->code] = [
                        'name' => $result->translate ? $result->translate->name : '',
                        'description' => $result->translate ? $result->translate->description : '',
                        'content' => $result->translate ? $result->translate->content : '',
                    ];
                }
            } else {
                $item['results'] = [];
            }



            $data[] = $item;
        }


        return $data;

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMail($email)
    {
        Yii::$app->mailer->compose()
            ->setFrom('result@urway.kz')
            ->setTo($email)
            ->setSubject('Баннер')
            ->setHtmlBody('<a href="http://urway.kz/ru"><img src="http://urway.kz/img/banner_ru.jpg"/></a>')
            ->send();
        Yii::$app->mailer->compose()
            ->setFrom('result@urway.kz')
            ->setTo($email)
            ->setSubject('Баннер')
            ->setHtmlBody('<a href="http://urway.kz/kz"><img src="http://urway.kz/img/banner_kz.jpg"/></a>')
            ->send();
        Yii::$app->mailer->compose()
            ->setFrom('result@urway.kz')
            ->setTo($email)
            ->setSubject('Баннер')
            ->setHtmlBody('<a href="http://urway.kz/en"><img src="http://urway.kz/img/banner_en.jpg"/></a>')
            ->send();
    }

    public function actionExample()
    {
        return $this->renderPartial('example');
    }
}
