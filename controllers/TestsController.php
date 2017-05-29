<?php

namespace app\controllers;

use app\models\Lang;
use app\models\TestName;
use app\models\TestQuestion;
use app\models\TestQuestionTranslate;
use Yii;
use app\models\Test;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestsController implements the CRUD actions for Test model.
 */
class TestsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Test::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        /** @var Lang $lang */
        foreach (Lang::find()->all() as $lang) {
            /** @var TestName $name */
            foreach ($model->names as $name) {
                if ($name->lang_id === $lang->id) {
                    continue 2;
                }
            }
            $name = new TestName();
            $name->test_id = $model->id;
            $name->lang_id = $lang->id;
            $name->date_update = time();
            $name->date_create = time();
            $name->save();
        }

        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            foreach ($model->names as $name) {
                $data = Yii::$app->request->post('TestName')[$name->id];
                $name->title = $data['title'];
                $name->subtitle = $data['title'];
                $name->description = $data['description'];
                $name->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionQuestions($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TestQuestion::find()->where(['test_id' => $id]),
        ]);

        return $this->render('questions', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQuestionUpdate($id, $parent)
    {
        /** @var TestQuestion $model */
        $model = TestQuestion::findOne($id);

        if(!$model)
            return $this->redirect(['questions', 'id' => $parent]);

        /** @var Lang $lang */
        foreach (Lang::find()->all() as $lang) {
            /** @var TestQuestionTranslate $translate */
            foreach ($model->translates as $translate) {
                if ($translate->lang_id === $lang->id) {
                    continue 2;
                }
            }
            $name = new TestQuestionTranslate();
            $name->question_id = $model->id;
            $name->lang_id = $lang->id;
            $name->date_update = time();
            $name->date_create = time();
            $name->save();
        }

        $model = TestQuestion::findOne($id);

        if (Yii::$app->request->isPost) {
            foreach ($model->translates as $translate) {
                $data = Yii::$app->request->post('TestQuestionTranslate')[$translate->id];
                $translate->question = $data['question'];
                $translate->answer_first = $data['answer_first'];
                $translate->answer_second = $data['answer_second'];
                $translate->save();
            }

            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
