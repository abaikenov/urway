<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property integer $date_update
 * @property integer $date_create
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
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
            [['date_update', 'date_create'], 'required'],
            [['date_update', 'date_create'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'questionsCount' => Yii::t('app', 'Questions Count'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }
    public function getName()
    {
        return $this->hasOne(TestName::className(), ['test_id' => 'id'])->where(['lang_id' => 1]);
    }

    public function getNames()
    {
        return $this->hasMany(TestName::className(), ['test_id' => 'id']);
    }

    public function getQuestionsCount()
    {
        return TestQuestion::find()->where(['test_id' => $this->id])->count();
    }

    public function getQuestions()
    {
        return $this->hasMany(TestQuestion::className(), ['test_id' => 'id']);
    }

    public function getResults()
    {
        return $this->hasMany(TestResult::className(), ['test_id' => 'id']);
    }

}
