<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party_history".
 *
 * @property int $id
 * @property int $party_id
 * @property int $history_type_id
 * @property string $changed
 * @property string $current
 * @property bool $active
 * @property bool $last
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Party $party
 * @property HistoryType $historyType
 */
class PartyHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['party_id', 'history_type_id', 'changed', 'current'/*, 'created_by', 'created'*/], 'required'],
            [['party_id', 'history_type_id', 'created_by', 'updated_by'], 'integer'],
            [['changed', 'current'], 'string'],
            [['active', 'last'], 'boolean'],
            [['created', 'updated'], 'safe'],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['history_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => HistoryType::className(), 'targetAttribute' => ['history_type_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['party_id'], 'exist', 'skipOnError' => true, 'targetClass' => Party::className(), 'targetAttribute' => ['party_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_id' => 'Party ID',
            'history_type_id' => 'History Type ID',
            'changed' => 'Changed',
            'current' => 'Current',
            'active' => 'Active',
            'last' => 'Last',
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
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryType()
    {
        return $this->hasOne(HistoryType::className(), ['id' => 'history_type_id']);
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
    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        // Only update row if it's an insert
        if ($insert) {
            $this->created_by = \Yii::$app->user->identity->id;
            $this->created = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            // Remove old histories with last active for the same party ID.
            Yii::$app->db->createCommand()->update(
                'party_history',
                ['last' => 0/*, 'created' => date('Y-m-d H:i:s')*/],
                ['and', 'id != :id', 'party_id = :party_id'],
                [':id' => $this->id, ':party_id' => $this->party_id]
            )->execute();
        }

        return parent::afterSave($insert, $changedAttributes);
    }
}
