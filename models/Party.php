<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party".

 * Attributes section
 * @property int $id
 * @property int $picture_id
 * @property int $address_id
 * @property string $name
 * @property string $number
 * @property string $code
 * @property string $description
 * @property string $since
 * @property string $until
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated

 * Relations section
 * @property Address $address
 * @property User $createdBy
 * @property User $updatedBy
 * @property Picture $picture
 * @property PartyHistory[] $partyHistory
 * @property PartyVisit[] $partyVisit
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
            [['picture_id', 'address_id', 'created_by', 'updated_by'], 'integer'],
            [['code'/*, 'created_by', 'created'*/], 'required'],
            [['description'], 'string'],
            [['since', 'until', 'created', 'updated'], 'safe'],
            [['since', 'until'], 'date', 'format' => 'php:Y-m-d'],
            ['until', 'compare', 'compareAttribute' => 'since', 'operator' => '>', 'enableClientValidation' => false],
            [['active'], 'boolean'],
            [['name'], 'string', 'max' => 127],
            [['number'], 'string', 'max' => 7],
            [['code'], 'string', 'max' => 15],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
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
            'picture_id' => 'Picture ID',
            'address_id' => 'Address ID',
            'name' => 'Name',
            'number' => 'Number',
            'code' => 'Code',
            'description' => 'Description',
            'since' => 'Since',
            'until' => 'Until',
            'active' => 'Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return array
     */
    public function attributesToIgnoreHistory()
    {
        return [
            'created_by',
            'updated_by',
            'created',
            'updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Picture::className(), ['id' => 'picture_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyHistory()
    {
        return $this->hasMany(PartyHistory::className(), ['party_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyVisit()
    {
        return $this->hasMany(PartyVisit::className(), ['party_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if ($insert) {
            $this->created_by = \Yii::$app->user->identity->id;
            $this->created = date('Y-m-d H:i:s');
        } else {
            $this->updated_by = \Yii::$app->user->identity->id;
            $this->updated = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->createNewHistory($insert, $changedAttributes);

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        $this->createOrUpdateVisits();

        return parent::afterFind();
    }

    /**
     * @param $insert
     * @param $changedAttributes
     * @return bool
     */
    private function createNewHistory($insert, $changedAttributes)
    {
        $ignoredAttributes = $this->attributesToIgnoreHistory();
        $currentAttributes = $this->toArray();

        foreach ($ignoredAttributes as $attribute) {
            unset($changedAttributes[$attribute]);
            unset($currentAttributes[$attribute]);
        }

        // Model attributes zone
        $partyHistory = new PartyHistory();

        $partyHistory->party_id = $this->id;
        $partyHistory->changed = json_encode($changedAttributes);
        $partyHistory->current = json_encode($currentAttributes);
        $partyHistory->last = true;

        if ($insert) {
            $partyHistory->history_type_id = HistoryType::HISTORY_TYPE_CREATED;
        } else {
            $partyHistory->history_type_id = HistoryType::HISTORY_TYPE_UPDATED;
        }

        return $partyHistory->save();
    }

    /**
     *
     */
    private function createOrUpdateVisits()
    {
        return;
    }
}

