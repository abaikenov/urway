<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $key
 * @property string $useable_count
 * @property integer $is_paid
 * @property integer $amount
 * @property integer $date_update
 * @property integer $date_create
 */
class School extends \yii\db\ActiveRecord
{
    public $confirmEmail;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
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
            [['name', 'email', 'amount'], 'required'],
            [['key', 'useable_count', 'is_paid', 'amount', 'date_update', 'date_create'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'School Name'),
            'email' => Yii::t('app', 'Email'),
            'confirmEmail' => Yii::t('app', 'Confirm Email'),
            'key' => Yii::t('app', 'Key'),
            'useable_count' => Yii::t('app', 'Useable Count'),
            'is_paid' => Yii::t('app', 'Is Paid'),
            'amount' => Yii::t('app', 'Amount'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    public function getKeys()
    {
        return $this->hasMany(SchoolKey::className(), ['school_id' => 'id']);
    }

    public function getKeysText()
    {
        $keys = '';
        foreach($this->keys as $key) {
            $keys .= $key->code . '<br/>';
        }
        return $keys;
    }

    public function generateKeys()
    {
        for($i = 1; $i <= 250; $i++) {
            $key = new SchoolKey();
            $key->school_id = $this->id;
            $key->code = $this->id . uniqid(str_pad($i, 3, 0, STR_PAD_LEFT));
            $key->save();
        }
    }

    public function generateKey()
    {
        $this->key = mt_rand(100000, 999999);
        $this->useable_count = 250;
    }

    public function getContent()
    {
        return $this->key;
    }
}
