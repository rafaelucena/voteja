<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $city_id
 * @property string $street
 * @property string $number
 * @property string $room
 * @property int $created_by
 * @property string $created
 * @property string $updated
 *
 * @property User $createdBy
 * @property City $city
 * @property Party[] $parties
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'created_by', 'created'], 'required'],
            [['city_id', 'created_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['street'], 'string', 'max' => 127],
            [['number'], 'string', 'max' => 7],
            [['room'], 'string', 'max' => 15],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'street' => 'Street',
            'number' => 'Number',
            'room' => 'Room',
            'created_by' => 'Created By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParties()
    {
        return $this->hasMany(Party::className(), ['address_id' => 'id']);
    }
}
