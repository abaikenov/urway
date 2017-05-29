<?php

namespace app\controllers;

use app\components\payment\KkbPayment;
use app\models\Order;
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
                if(null != $order) {
                    $resultKeys = [];

                    foreach (json_decode($order->result) as $testId => $result) {

                        switch ($testId + 1) {
                            case 1:
                                // первый тест
                                $types = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                                foreach ($result as $key => $value) {
                                    if($value->answer === "true") {
                                        $k = ($key + 1) % 5;
                                        if($k > 0) {
                                            $types[$k] += 1;
                                        } else {
                                            $types[5] += 1;
                                        }
                                    }
                                }
                                foreach ($types as $typeKey => $type) {
                                    if($type === max($types))
                                        $resultKeys[$testId + 1][] = $typeKey;
                                }
                                break;
                            case 2:
                                break;
                            case 3:
                                break;
                            default:
                                break;
                        }
                    }

                    var_dump($resultKeys);
//                    var_dump(json_decode($order->result));

//                    $order->is_paid = 1;
//                    $order->save();
                }
            };
        }

        return 0;
    }

}
