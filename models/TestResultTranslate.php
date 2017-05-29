<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result_translate".
 *
 * @property integer $id
 * @property integer $result_id
 * @property integer $lang_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $date_update
 * @property integer $date_create
 */
class TestResultTranslate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_result_translate';
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
            [['result_id', 'lang_id', 'date_update', 'date_create'], 'required'],
            [['result_id', 'lang_id', 'date_update', 'date_create'], 'integer'],
            [['description', 'content'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'result_id' => Yii::t('app', 'Result ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }
}
