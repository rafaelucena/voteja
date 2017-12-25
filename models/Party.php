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
 * @property PartyHistory[] $partyHistory
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
            [['code', /*'created_by', 'created'*/], 'required'],
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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
    public function getPartyHistory()
    {
        return $this->hasMany(PartyHistory::className(), ['party_id' => 'id']);
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
            $partyHistory->history_status_id = HistoryStatus::HISTORY_STATUS_CREATED;
        } else {
            $partyHistory->history_status_id = HistoryStatus::HISTORY_STATUS_UPDATED;
        }

        return $partyHistory->save();
    }
}

