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
                    $result = $order->getResult();

                    try {
                        $mail = Yii::$app->mailer->compose('test/result', ['content' => $result['body']])
                            ->setFrom('result@urway.kz')
                            ->setTo($order->email)
                            ->setSubject('Результаты теста');
                        foreach ($result['files'] as $file) {
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