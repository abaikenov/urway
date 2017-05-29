<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_name".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $lang_id
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property integer $date_update
 * @property integer $date_create
 */
class TestName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_name';
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
            [['test_id', 'lang_id', 'date_update', 'date_create'], 'required'],
            [['test_id', 'lang_id', 'date_update', 'date_create'], 'integer'],
            [['description'], 'string'],
            [['title', 'subtitle'], 'string', 'max' => 255],
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
            'lang_id' => Yii::t('app', 'Lang ID'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'description' => Yii::t('app', 'Description'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}
