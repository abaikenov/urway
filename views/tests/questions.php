<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tests Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-questions">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'translate.question',
            'translate.answer_first',
            'translate.answer_second',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{question-view} {question-update}',
                'buttons' => [
                    'question-view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url.'&parent='.Yii::$app->request->get('id'), [
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },
                    'question-update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url.'&parent='.Yii::$app->request->get('id'), [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
//                    'question-delete' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                            'title' => Yii::t('yii', 'Delete'),
//                        ]);
//                    }
                ]
            ],
        ],
    ]); ?>
</div>
