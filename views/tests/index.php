<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name.title',
            'name.subtitle',
            'questionsCount',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {questions} {results}',
                'buttons' => [
                    'questions' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-question-sign"></span>', $url, [
                            'title' => Yii::t('yii', 'Questions'),
                        ]);

                    },
                    'results' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                            'title' => Yii::t('yii', 'Results'),
                        ]);

                    }
                ]
            ],
        ],
    ]); ?>
</div>
