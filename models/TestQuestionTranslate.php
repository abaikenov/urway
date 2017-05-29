<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_question_translate".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $lang_id
 * @property string $question
 * @property string $answer_first
 * @property string $answer_second
 * @property integer $date_update
 * @property integer $date_create
 */
class TestQuestionTranslate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_question_translate';
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
            [['question_id', 'lang_id', 'date_update', 'date_create'], 'required'],
            [['question_id', 'lang_id', 'date_update', 'date_create'], 'integer'],
            [['question'], 'string'],
            [['answer_first', 'answer_second'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'question' => Yii::t('app', 'Question'),
            'answer_first' => Yii::t('app', 'Answer First'),
            'answer_second' => Yii::t('app', 'Answer Second'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }
}
