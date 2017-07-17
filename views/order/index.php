<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'email:email',
            'is_paid:boolean',
            [
                'attribute' => 'amount',
                'value' => function($model) {
                    return $model->amount.' тг.';
                },
            ],
            [
                'attribute' => 'date_create',
                'value' => function($model) {
                    return date('d.m.Y H:i:s', $model->date_create);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{send}',
                'buttons' => [
                    'send' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-send"></span>', $url, [
                            'title' => Yii::t('yii', 'Send'),
                            'target' => '_blank'
                        ]);

                    },
                ]
            ],
        ],
    ]); ?>
</div>
