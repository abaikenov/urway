<?php

namespace app\controllers;

use app\components\payment\KkbPayment;
use app\models\Order;
use app\models\TestResult;
use Swift_TransportException;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class PostLinkController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    // Постлинк для оплаты
    public function actionIndex()
    {
//        $_POST['response'] = '<document><bank name="Kazkommertsbank JSC"><customer name="Ucaf Test Maest" mail="SeFrolov@kkb.kz" phone=""><merchant cert_id="00C182B189" name="test merch"><order order_id="0706172110" amount="1000" currency="398"><department merchant_id="92056001" amount="1000"/></order></merchant><merchant_sign type="RSA"/></customer><customer_sign type="RSA"/><results timestamp="2006-07-06 17:21:50"><payment merchant_id="92056001" amount="1000" reference="618704198173" approval_code="447753" response_code="00"/></results></bank><bank_sign cert_id="00C18327E8" type="SHA/RSA">xjJwgeLAyWssZr3/gS7TI/xaajoF3USk0B/ZfLv6SYyY/3H8tDHUiyGcV7zDO5+rINwBoTn7b9BrnO/kvQfebIhHbDlCSogz2cB6Qa2ELKAGqs8aDZDekSJ5dJrgmFT6aTfgFgnZRmadybxTMHGR6cn8ve4m0TpQuaPMQmKpxTI=</bank_sign ></document>';
        $path1 = '../paysys/config.txt';
        $response = '';
        if (isset($_POST["response"])) {
            $response = $_POST["response"];
        };
        $result = KkbPayment::process_response(stripslashes($response), $path1);

        if (is_array($result)) {
            if (in_array("ERROR", $result)) {
            };
            if (in_array("DOCUMENT", $result)) {
                /** @var Order $order */
                $order = Order::find()->where(['id' => intval($result['ORDER_ORDER_ID']), 'amount' => $result['PAYMENT_AMOUNT'], 'is_paid' => false])->one();
                if (null != $order) {
                    $allResults = json_decode($order->result);
                    $files = [];
                    $questionnaire = $allResults[0];
                    unset($allResults[0]);
                    $questionnaireResult = TestResult::find()->where(['test_id' => 1, 'code' => $questionnaire->code])->one();
                    $files[] = $questionnaireResult->translate->file_path;
                    $html = '';

                    if (count($allResults)) {
                        $resultKeys = [];
                        $html .= '<p>' . Yii::t('app', 'Your results') . ':</p>';


                        foreach ($allResults as $testId => $result) {
                            switch ($testId) {
                                case 1:
                                    // первый тест
                                    $types = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                                    foreach ($result as $key => $value) {
                                        if ($value->answer === "true") {
                                            $k = ($key + 1) % 5;
                                            if ($k > 0) {
                                                $types[$k] += 1;
                                            } else {
                                                $types[5] += 1;
                                            }
                                        }
                                    }
                                    foreach ($types as $typeKey => $type) {
                                        if ($type === max($types))
                                            $resultKeys[$testId][] = $typeKey;
                                    }
                                    break;
                                case 2:
                                    // второй тест
                                    $types = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                                    $answers = [
                                        1 => [
                                            4 => 1,
                                            7 => 1,
                                            11 => 1,
                                            13 => 1,
                                            18 => 2,
                                            25 => 2,
                                            28 => 1,
                                        ],
                                        2 => [
                                            2 => 1,
                                            9 => 2,
                                            16 => 2,
                                            21 => 1,
                                            26 => 1,
                                        ],
                                        3 => [
                                            5 => 1,
                                            8 => 1,
                                            14 => 2,
                                            19 => 2,
                                            22 => 1,
                                            29 => 1,
                                        ],
                                        4 => [
                                            3 => 1,
                                            10 => 2,
                                            12 => 1,
                                            17 => 2,
                                            24 => 1,
                                            30 => 1,
                                        ],
                                        5 => [
                                            1 => 1,
                                            6 => 1,
                                            15 => 2,
                                            20 => 1,
                                            23 => 2,
                                            27 => 1,
                                        ]
                                    ];

                                    foreach ($result as $key => $value) {
                                        foreach ($answers as $answerKey => $answer) {
                                            $k = ($key + 1);

                                            if (isset($answer[$k])) {
                                                if ($value->answer === "true") {
                                                    $types[$answerKey] += $answer[$k];
                                                } else {
                                                    $types[$answerKey] -= $answer[$k];
                                                }
                                            }
                                        }
                                    }

                                    foreach ($types as $typeKey => $type) {
                                        if ($type === max($types))
                                            $resultKeys[$testId][] = $typeKey;
                                    }
                                    break;
                                case 3:
                                    // третий тест
                                    $types = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
                                    $answers = [
                                        1 => [
                                            1 => "true",
                                            2 => "true",
                                            3 => "true",
                                            4 => "true",
                                            5 => "true",
                                            16 => "true",
                                            17 => "true",
                                            18 => "true",
                                            19 => "true",
                                            20 => "true",
                                            31 => "true",
                                            32 => "true",
                                            33 => "true",
                                            34 => "true",
                                            35 => "true",
                                        ],
                                        2 => [
                                            1 => "false",
                                            6 => "true",
                                            7 => "true",
                                            8 => "true",
                                            9 => "true",
                                            16 => "false",
                                            21 => "true",
                                            22 => "true",
                                            23 => "true",
                                            24 => "true",
                                            31 => "false",
                                            36 => "true",
                                            37 => "true",
                                            38 => "true",
                                            39 => "true",
                                        ],
                                        3 => [
                                            2 => "false",
                                            6 => "false",
                                            10 => "true",
                                            11 => "true",
                                            12 => "true",
                                            17 => "false",
                                            21 => "false",
                                            25 => "true",
                                            26 => "true",
                                            27 => "true",
                                            32 => "false",
                                            36 => "false",
                                            40 => "true",
                                            41 => "true",
                                            42 => "true",
                                        ],
                                        4 => [
                                            3 => "false",
                                            7 => "false",
                                            10 => "false",
                                            13 => "true",
                                            14 => "true",
                                            18 => "false",
                                            22 => "false",
                                            25 => "false",
                                            28 => "true",
                                            29 => "true",
                                            33 => "false",
                                            37 => "false",
                                            40 => "false",
                                        ],
                                        5 => [
                                            4 => "false",
                                            8 => "false",
                                            11 => "false",
                                            13 => "false",
                                            15 => "true",
                                            19 => "false",
                                            23 => "false",
                                            26 => "false",
                                            28 => "false",
                                            30 => "true",
                                            34 => "false",
                                            38 => "false",
                                            41 => "false",
                                        ],
                                        6 => [
                                            5 => "false",
                                            9 => "false",
                                            12 => "false",
                                            14 => "false",
                                            15 => "false",
                                            20 => "false",
                                            24 => "false",
                                            27 => "false",
                                            29 => "false",
                                            30 => "false",
                                            35 => "false",
                                            42 => "false",
                                        ]
                                    ];

                                    foreach ($result as $key => $value) {
                                        foreach ($answers as $answerKey => $answer) {
                                            $k = ($key + 1);
                                            if (isset($answer[$k]) && ($answer[$k] === $value->answer)) {
                                                $types[$answerKey] += 1;
                                            }
                                        }
                                    }

                                    foreach ($types as $typeKey => $type) {
                                        if ($type === max($types))
                                            $resultKeys[$testId][] = $typeKey;
                                    }
                                    break;
                                default:
                                    break;
                            }
                        }

                        // достаем из базы текста результатов
                        foreach ($resultKeys as $testId => $resultIds) {
                            $testResults = TestResult::find()->where(['test_id' => $testId + 1])->all();

                            switch ($testId) {
                                case 1:
                                    $html .= '<p>' . Yii::t('app', '{testId}. {name}, you have {count} basic type of thinking.', ['testId' => $testId, 'name' => $order->name, 'count' => count($resultIds)]) . '</p>';
                                    break;
                                case 2:
                                    $html .= '<p>' . Yii::t('app', '{testId}. {name}, you have {count} professional inclinations.', ['testId' => $testId, 'name' => $order->name, 'count' => count($resultIds)]) . '</p>';
                                    break;
                                case 3:
                                    $html .= '<p>' . Yii::t('app', '{testId}. {name}, you have {count} primary type of personality.', ['testId' => $testId, 'name' => $order->name, 'count' => count($resultIds)]) . '</p>';
                                    break;
                                default:
                                    break;
                            }

                            foreach ($resultIds as $resultId) {
                                $testResult = $testResults[$resultId - 1];
                                if ($testResult->translate) {
                                    $html .= '<p><strong>' . $testResult->translate->name . '</strong></p>';
                                    $html .= $testResult->translate->content;
                                    $html .= '<br/>';
                                    if ($testResult->translate->file_path)
                                        $files[] = $testResult->translate->file_path;
                                }
                            }
                        }

                        $html .= '<hr>';
                    }

                    $html .= '<p>' . Yii::t('app', 'Мы надеемся, что результаты UrWay.kz помогут Вам при выборе профессии, хобби, раскрыть таланты, лучше узнать Ваши способности. Снизу мы приводим типичные ошибки при выборе профессии и рекомендации во их избежания.') . '</p>';
                    $html .= '<p style="color: #ff0000; font-weight: bold">' . Yii::t('app', 'Ошибочные причины при выборе профессии:') . '</p>';
                    $html .= '<ul style="list-style: none">';
                    $html .= '<li>' . Yii::t('app', '1. Заработная плата (ориентир исключительно на деньги)') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '2. Престиж, мода профессии (не нужно гнаться за модой, найдите свое собственное призвание)') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '3. "Династийность" (в передаче бизнеса от отца к сыну нет ничего плохого, но это не должен быть приоретом при выборе профессии; идея, что будет "проще пробиться", "легче устроиться" не должны быть привелирующими).') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '4. Выбирать, опираясь исключительно на любимые предметы ("люблю биологию, быть мне медиком"; зачастую наши способности и таланты намного шире одного предмета изучения).') . '.</li>';
                    $html .= '</ul>';
                    $html .= '<p style="color: #17AD17; font-weight: bold">' . Yii::t('app', 'Правильные ориентиры при выборе профессии:') . '</p>';
                    $html .= '<ul style="list-style: none">';
                    $html .= '<li>' . Yii::t('app', '1. Интерес, увлечение, любимое занятие (то, чем бы Вы могли заниматься БЕСПЛАТНО!)') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '2. Исходя из того, что лучше и легче всего получается.') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '3. Талант - природное дарование; то, что получается без труда и естественно.') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '4. МЕЧТЫ И ЦЕЛИ по жизни должны сопутствовать Вашему Призванию.') . '.</li>';
                    $html .= '</ul>';
                    $html .= '<p style="color: #0001ad; font-weight: bold">' . Yii::t('app', 'Практические рекомендации:') . '</p>';
                    $html .= '<ul style="list-style: none">';
                    $html .= '<li>' . Yii::t('app', '1. Попробовать заняться понравившейся профессией/деятельностью.') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '2. Консультация с успешными людьми этой профессии.') . '.</li>';
                    $html .= '<li>' . Yii::t('app', '3. Не бояться пробовать и экспериментировать на пути к своему Призванию.') . '.</li>';
                    $html .= '</ul>';
                    $html .= '<p style="font-size: 11px">' . Yii::t('app', 'При возникновении проблем по получению результата тестов, просим написать нам: <a href="mailto:urway99@gmail.com">urway99@gmail.com</a>') . '.</p>';

                    try {
                        $mail = Yii::$app->mailer->compose('test/result', ['content' => $html])
                            ->setFrom('result@urway.kz')
                            ->setTo($order->email)
                            ->setSubject('Результаты теста');
                        foreach ($files as $file) {
                            if (file_exists(Yii::getAlias('@app/web') . $file))
                                $mail->attach(Yii::getAlias('@app/web') . $file);
                        }
                        if ($mail->send()) {
                            $order->is_paid = 1;
                            $order->save();
                        } else {
                            return;
                        }
                    } catch (Swift_TransportException $e) {
                        return;
                    }
                }
            };
        }

        return 0;
    }

}