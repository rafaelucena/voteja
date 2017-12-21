<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property int $id
 * @property string $avatar
 * @property string $name
 * @property string $short
 * @property string $code
 * @property string $description
 * @property string $since
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property PartyHistory[] $partyHistories
 */
class Party extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'created_by', 'created'], 'required'],
            [['description'], 'string'],
            [['since', 'created', 'updated'], 'safe'],
            [['active'], 'boolean'],
            [['created_by', 'updated_by'], 'integer'],
            [['avatar'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 127],
            [['short'], 'string', 'max' => 31],
            [['code'], 'string', 'max' => 15],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => 'Avatar',
            'name' => 'Name',
            'short' => 'Short',
            'code' => 'Code',
            'description' => 'Description',
            'since' => 'Since',
            'active' => 'Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('parties');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('parties0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyHistories()
    {
        return $this->hasMany(PartyHistory::className(), ['party_id' => 'id'])->inverseOf('party');
    }
}
