<?php

namespace app\controllers;

use app\components\payment\KkbPayment;
use app\models\School;
use Swift_TransportException;
use Yii;
use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_create' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGet($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($order = Order::findOne($id))
            return Order::findOne($id);
        else
            return [];
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('name');
            $email = Yii::$app->request->post('email');
            $result = Yii::$app->request->post('result');

            if (count($result) === 1) {
                $amount = 490;
            } else {
                $amount = 990;
            }

            $order = new Order();
            $order->name = $name;
            $order->email = $email;
            $order->amount = $amount;
            $order->result = json_encode($result);
            if ($order->validate() && $order->save()) {
                $sign = KkbPayment::process_request($order->id, '398', $order->amount, \Yii::getAlias('@app') . '/paysys/config.txt');
                return [
                    'id' => $order->id,
                    'sign' => $sign
                ];
            } else
                return $order->errors;
        }

        return [
            'error' => 'Bad request'
        ];
    }

    public function actionCreateWithKey()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('name');
            $email = Yii::$app->request->post('email');
            $result = Yii::$app->request->post('result');
            $key = Yii::$app->request->post('key');

            $school = School::findOne(['key' => $key]);
            if ($school && $school->useable_count > 0) {
                $order = new Order();
                $order->name = $name;
                $order->email = $email;
                $order->amount = 0;
                $order->is_paid = 1;
                $order->key = $school->key;
                $order->result = json_encode($result);
                if ($order->validate() && $order->save()) {
                    $result = $order->getResult();
                    try {
                        $mail = Yii::$app->mailer->compose('test/result', ['content' => $result['body']])
                            ->setFrom('result@urway.kz')
                            ->setTo($order->email)
                            ->setSubject(Yii::t('app', 'Test result'));
                        foreach ($result['files'] as $file) {
                            if (file_exists(Yii::getAlias('@app/web') . $file))
                                $mail->attach(Yii::getAlias('@app/web') . $file);
                        }
                        if ($mail->send()) {
                            $school->useable_count = $school->useable_count - 1;
                            $school->save();
                            return [
                                'success' => true,
                                'id' => $order->id,
                            ];
                        } else {
                            return [
                                'success' => false,
                                'error' => 'Не удалось использовать ключ',
                            ];
                        }
                    } catch (Swift_TransportException $e) {
                        return [
                            'success' => false,
                            'error' => 'Не удалось использовать ключ',
                        ];
                    }

                } else
                    return [
                        'success' => false,
                        'error' => $order->errors,
                    ];
            } else {
                return [
                    'success' => false,
                    'error' => Yii::t('app', 'Invalid key!')
                ];
            }
        }

        return [
            'error' => 'Bad request'
        ];
    }

    public function actionSend($id)
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        if ($order = Order::findOne($id)) {
            $result = $order->getResult();
            try {
                $mail = Yii::$app->mailer->compose('test/result', ['content' => $result['body']])
                    ->setFrom('result@urway.kz')
                    ->setTo($order->email)
                    ->setSubject(Yii::t('app', 'Test result'));
                foreach ($result['files'] as $file) {
                    if (file_exists(Yii::getAlias('@app/web') . $file))
                        $mail->attach(Yii::getAlias('@app/web') . $file);
                }
                if ($mail->send()) {
                    echo 'Результат успешно отправлен на почту ' . $order->email;
                } else {
                    echo 'Не удалось отправить сообщение';
                }
            } catch (Swift_TransportException $e) {
                echo 'Не удалось отправить сообщение: ' . $e->getMessage();
            }
        } else
            echo 'Заказ не найден!';
    }
}
