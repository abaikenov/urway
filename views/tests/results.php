<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \app\models\Test */

$this->title = Yii::t('app', 'Tests Results');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-questions">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'translate.name',
            'translate.description',
            'translate.content:raw',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{result-update}',
                'buttons' => [
                    'result-update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url.'&parent='.Yii::$app->request->get('id').'&page='.Yii::$app->request->get('page'), [
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
