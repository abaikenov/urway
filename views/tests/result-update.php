<?php

use app\models\Lang;
use dosamigos\fileupload\FileUpload;
use kartik\file\FileInput;
use vova07\imperavi\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestResult */
/* @var $test app\models\Test */

$this->title = Yii::t('app', 'Update Result: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $test->name->title, 'url' => ['view', 'id' => $test->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests Results'), 'url' => ['results', 'id' => Yii::$app->request->get('parent')]];
$this->params['breadcrumbs'][] = '№' . $model->id;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="test-form">

        <?php $form = ActiveForm::begin(); ?>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <?php /** @var \app\models\Lang $lang */
            foreach (Lang::find()->all() as $lang):?>
                <li role="presentation" <?= Lang::getDefaultLang()->id === $lang->id ? 'class="active"' : '' ?>><a
                            href="#lang<?= $lang->id ?>" aria-controls="lang<?= $lang->id ?>" role="tab"
                            data-toggle="tab"><?= $lang->name ?></a></li>
            <?php endforeach; ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding: 15px 0">
            <?= $form->field($model, 'code')->textInput() ?>
            <?php /** @var \app\models\Lang $lang */
            foreach (Lang::find()->all() as $lang):?>
                <div role="tabpanel" class="tab-pane <?= Lang::getDefaultLang()->id === $lang->id ? 'active' : '' ?>"
                     id="lang<?= $lang->id ?>">
                    <?php /** @var \app\models\TestResultTranslate $translate */
                    foreach ($model->translates as $translate):?>
                        <?php if ($translate->lang_id === $lang->id): ?>
                            <?= $form->field($translate, '[' . $translate->id . ']name')->textInput() ?>
                            <?= $form->field($translate, '[' . $translate->id . ']description')->textInput() ?>
                            <?= $form->field($translate, '[' . $translate->id . ']content')->widget(Widget::className(), [
                                'settings' => [
                                    'lang' => 'ru',
                                    'minHeight' => 200,
                                    'plugins' => [
                                        'fullscreen'
                                    ]
                                ]
                            ]); ?>
                            <?= $form->field($translate, '[' . $translate->id . ']file')->widget(FileInput::className(), [
                                'options' => ['accept' => '.doc, .pdf'],
                                'pluginOptions' => [
                                    'initialPreview' => [
                                        "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                                    ],
                                    'initialCaption' => $translate->file_name ? $translate->file_name : 'Файл не выбран',
                                    'showPreview' => false,
                                    'showCaption' => true,
                                    'showRemove' => true,
                                    'showUpload' => false
                                ]
                            ]); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
