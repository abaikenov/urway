<?php

namespace app\controllers;

use app\actions\SubmitFormAction;
use app\backend\models\Rent;
use app\components\C;
use app\components\payment\KkbPayment;
use app\modules\core\components\MailComponent;
use app\modules\shop\models\Category;
use app\modules\shop\models\Order;
use app\modules\shop\models\OrderTransaction;
use app\modules\shop\models\Product;
use app\models\Search;
use app\modules\seo\behaviors\MetaBehavior;
use Yii;
use yii\helpers\Url;
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
                $rent = Rent::find()->where(['hash' => $result['ORDER_ORDER_ID'], 'total' => $result['PAYMENT_AMOUNT']])->one();
                if(null != $rent) {
                    $rent->toUse();
                }
            };
        }

        return 0;
    }

}
