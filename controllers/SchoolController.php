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

class SchoolController extends Controller
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
            'query' => School::find(),
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

    public function actionCheck($id)
    {
        $school = School::findOne($id);
        if(!$school || !$school->is_paid) {
            return $this->goHome();
        } else {
            return $this->renderPartial('check');
        }
    }

    public function actionSend($id)
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        $school = School::findOne($id);
        if($school) {
            try {
                $mail = Yii::$app->mailer->compose('test/result', ['content' => $school->getContent()])
                    ->setFrom('result@urway.kz')
                    ->setTo($school->email)
                    ->setSubject('Ключи для теста');
                if ($mail->send()) {
                    echo 'Ключи успешно отправлены на почту '. $school->email;
                } else {
                    echo 'Не удалось отправить ключи на почту';
                }
            } catch (Swift_TransportException $e) {
                echo 'Не удалось отправить ключи на почту: '.$e->getMessage();
            }
        } else
            echo 'Школа не найдена!';
    }
}
