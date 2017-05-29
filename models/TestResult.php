<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result".
 *
 * @property integer $id
 * @property integer $test_id
 * @property string $code
 * @property integer $date_update
 * @property integer $date_create
 */
class TestResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_result';
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
            [['code'], 'string', 'max' => 255],
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
            'code' => Yii::t('app', 'Code'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    public function getTranslate()
    {
        return $this->hasOne(TestResultTranslate::className(), ['result_id' => 'id'])->where(['lang_id' => 1]);
    }

    public function getTranslates()
    {
        return $this->hasMany(TestResultTranslate::className(), ['result_id' => 'id']);
    }
}
