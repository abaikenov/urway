<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_keys".
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $is_used
 * @property string $code
 * @property integer $date_update
 * @property integer $date_create
 */
class SchoolKey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_keys';
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
            [['school_id', 'code'], 'required'],
            [['is_used', 'school_id', 'date_update', 'date_create'], 'integer'],
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
            'school_id' => Yii::t('app', 'School'),
            'code' => Yii::t('app', 'Key'),
            'is_used' => Yii::t('app', 'Is Used'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

}
