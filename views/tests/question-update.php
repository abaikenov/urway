<?php

use app\models\Lang;
use vova07\imperavi\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = Yii::t('app', 'Update Question: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['questions', 'id' => Yii::$app->request->get('parent')]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
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
            <?php /** @var \app\models\Lang $lang */
            foreach (Lang::find()->all() as $lang):?>
                <div role="tabpanel" class="tab-pane <?= Lang::getDefaultLang()->id === $lang->id ? 'active' : '' ?>"
                     id="lang<?= $lang->id ?>">
                    <?php /** @var \app\models\TestQuestionTranslate $translate */
                    foreach ($model->translates as $translate):?>
                        <?php if ($translate->lang_id === $lang->id): ?>
                            <?= $form->field($translate, '[' . $translate->id . ']question')->textInput() ?>
                            <?= $form->field($translate, '[' . $translate->id . ']answer_first')->textInput() ?>
                            <?= $form->field($translate, '[' . $translate->id . ']answer_second')->textInput() ?>
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
