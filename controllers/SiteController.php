<?php

namespace app\controllers;

use app\models\Lang;
use app\models\Test;
use app\models\TestName;
use app\models\TestQuestion;
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
        return $this->renderPartial('index', ['langs' => $langs]);
    }

    public function actionTest()
    {
        return $this->renderPartial('test');
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

//        return [
//            [
//                'title' => 'ОПРОСНИК',
//                'subtitle' => '«Ваш психологический портрет»',
//                'description' => '<p>В каждой из 28 пар утверждений выберите одно (А или Б), которое больше подходит в отношении Вас. Помните, что среди них нет плохих или хороших, правильных или неправильных – все они равноценны.</p><p><strong>Старайтесь отвечать быстро, недолго размышляя над ответами.</strong></p>',
//                'questions' => [],
//                'answers' => [
//                    [
//                        'first' => 'Заряжаюсь энергией при общении с другими людьми (люблю бывать в компаниях)',
//                        'second' => 'Заряжаюсь энергией в спокойной обстановке (люблю круг близких друзей)'
//                    ],
//                    [
//                        'first' => 'Доверяю тому, что надежно',
//                        'second' => 'Доверяю вдохновению и люблю игру ума'
//                    ]
//                ],
//                'results' => [
//                    'ISTJ' => [
//                        'name' => 'Максим Горький',
//                        'description' => 'систематик, попечитель. Делать то, что должно быть сделано, любовь – достойная цель. Прирожденные организаторы жизни.',
//                        'content' => 'Обладает явно выраженной способностью к логическому мышлению. Все изученное систематизирует и классифицирует. Борется за внедрение лучшей, по его мнению, разработки или системы. Ясно и понятно высту­пает, готовясь к выступлениям даже в мелочах. Всегда подтянут и собран. Тщательно следит за своей одеждой, достаточно строгой по стилю. Хоро­шо выполняет трудную работу, требующую высокой точности. Сам дис­циплинирован и того же требует от других. Не любит в других склонности к бесплодным фантазиям, не позволяет этого и себе. Может оказывать силовое, властное давление, но относится к людям с осторожностью. Как правило, хорошо работает руками. Внимательно слушает собеседника, может одновременно слушать двоих, вникая при этом в мельчайшие детали. С трудом может понять, чего можно ждать в будущем от того или иного человека. Односторонен и замкнут. В качестве руководителя очень требователен. В качестве подчиненного с начальством обычно не спорит, а старается просто выполнить указания. Любит определенный порядок расположения вещей и раздражается, когда кто-то этот порядок наруша­ет. При общении с людьми то приближает их к себе, то становится недоступным. Самая сильная сторона—умение методично, логически мыслить, проникать в самую суть вещей и явлений.'
//                    ],
//                    'ISTP' => [
//                        'name' => 'Габен',
//                        'description' => 'Мастер, Джаконда. Легкие на подъем. Дела говорят больше, чем слова. Просто делай.',
//                        'content' => 'Обладает хорошим вкусом, ему свойственно эстетическое восприятие окружающего мира. Твердый и загадочный, со спокойными и точными движениями. Хорошая память=> воспоминания могут относиться к самым ранним годам жизни. Созидатель, но с реализацией своих замыслов не торопится, ждет подходящего момента. Постоянно занимается созданием уюта и комфорта, хорошо, оригинально и со вкусом одевается. Настойчив в достижении целей, с интересом относится ко всему новому, но обязатель­но считает нужным оценить это новое с позиций уже имеющегося опыта. Рационален, даже из малополезных вещей умеет извлечь пользу. Высо­кая ответственность за дело=> четко придерживается заведенного распо­рядка, слывет пунктуальным человеком. Эмоционально сдержан, ревнив и недоверчив. Иногда его принимают за болтуна, создается впечатление, что он ничего не делает, а только много говорит. На самом же деле он ждет, когда появится цель деятельности, для достижения которой стоит работать. Самая сильная сторона—умение защитить интересы близких, создать творческую атмосферу.'
//                    ],
//                ]
//            ],
//            [
//                'title' => 'ТЕСТ',
//                'subtitle' => '«ТИП МЫШЛЕНИЯ»',
//                'description' => '<p>У каждого человека преобладает определенный тип мышления. Данный тест поможет Вам определить тип своего мышления. Если согласны с высказыванием, поставьте «Да», если не согласны «Нет».</p><p><strong>Старайтесь отвечать быстро, недолго размышляя над ответами.</strong></p>',
//                'questions' => [
//                    'Мне легче что-либо сделать самому, чем объяснить другому.',
//                    'Мне интересно было бы составлять компьютерные программы.'
//                ],
//                'answers' => [
//                    [
//                        'first' => 'Да',
//                        'second' => 'Нет'
//                    ],
//                    [
//                        'first' => 'Да',
//                        'second' => 'Нет'
//                    ]
//                ],
//                'results' => []
//            ],
//            [
//                'title' => 'ТЕСТ',
//                'subtitle' => '«ОПРЕДЕЛЕНИЕ ПРОФЕССИОНАЛЬНЫХ СКЛОННОСТЕЙ»',
//                'description' => '<p>Все виды профессиональной деятельности по содержанию труда, по отношению человека к объектам окружающего мира можно разделить на 5 основных типов. Предлагаем Вам оценить свои склонности к тому или иному типу деятельности. Для этого поставьте «+», если Вы согласны с приведенным утверждением, и «-», если не согласны.</p><p><strong>Старайтесь отвечать быстро, недолго размышляя над ответами.</strong></p>',
//                'questions' => [
//                    'Я легко знакомлюсь с людьми.',
//                    'Охотно и подолгу могу что-нибудь мастерить.'
//                ],
//                'answers' => [
//                    [
//                        'first' => 'Да',
//                        'second' => 'Нет'
//                    ],
//                    [
//                        'first' => 'Да',
//                        'second' => 'Нет'
//                    ]
//                ],
//                'results' => []
//            ],
//            [
//                'title' => 'ТЕСТ',
//                'subtitle' => '«МЕТОДИКА ПРОФЕССИОНАЛЬНОГО САМООПРЕДЕЛЕНИЯ»',
//                'description' => '<p>Вам предлагается 42 пары профессий, причем каждой паре Вы обязаны выбрать одну: наиболее желательную и привлекательную для Вас из предложенных.</p><p><strong>Старайтесь отвечать быстро, недолго размышляя над ответами.</strong></p>',
//                'questions' => [],
//                'answers' => [
//                    [
//                        'first' => 'инженер-техник',
//                        'second' => 'инженер-контролер'
//                    ],
//                    [
//                        'first' => 'вязальщик',
//                        'second' => 'санитарный врач'
//                    ]
//                ],
//                'results' => []
//            ],
//        ];
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
}
