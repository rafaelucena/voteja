<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history_status".
 *
 * @property int $id
 * @property string $name
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
class HistoryStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'boolean'],
            [['created_by', 'created'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 31],
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
            'name' => 'Name',
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
        return $this->hasOne(User::className(), ['id' => 'updated_by'])->inverseOf('historyStatuses');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by'])->inverseOf('historyStatuses0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyHistories()
    {
        return $this->hasMany(PartyHistory::className(), ['history_status_id' => 'id'])->inverseOf('historyStatus');
    }
}
