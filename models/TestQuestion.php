<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_question".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $date_update
 * @property integer $date_create
 */
class TestQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_question';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'date_update', 'date_create'], 'required'],
            [['test_id', 'date_update', 'date_create'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    public function getTranslate()
    {
        return $this->hasOne(TestQuestionTranslate::className(), ['question_id' => 'id'])->where(['lang_id' => Lang::getCurrent()->id]);
    }

    public function getTranslates()
    {
        return $this->hasMany(TestQuestionTranslate::className(), ['question_id' => 'id']);
    }
}
