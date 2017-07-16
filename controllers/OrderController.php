<?php

namespace app\controllers;

use app\components\payment\KkbPayment;
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
        if($order = Order::findOne($id))
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

            if(count($result) === 1) {
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
}
