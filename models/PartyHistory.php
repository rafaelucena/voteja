<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party_history".
 *
 * @property int $id
 * @property int $party_id
 * @property int $history_status_id
 * @property string $changed
 * @property string $current
 * @property bool $last
 * @property int $created_by
 * @property string $created
 *
 * @property HistoryStatus $historyStatus
 * @property User $createdBy
 * @property Party $party
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
            [['party_id', 'history_status_id', 'changed', 'current'/*, 'created_by', 'created'*/], 'required'],
            [['party_id', 'history_status_id', 'created_by'], 'integer'],
            [['changed', 'current'], 'string'],
            [['last'], 'boolean'],
            [['created'], 'safe'],
            [['history_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => HistoryStatus::className(), 'targetAttribute' => ['history_status_id' => 'id']],
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
            'history_status_id' => 'History Status ID',
            'changed' => 'Changed',
            'current' => 'Current',
            'last' => 'Last',
            'created_by' => 'Updated By',
            'created' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryStatus()
    {
        return $this->hasOne(HistoryStatus::className(), ['id' => 'history_status_id']);
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
        $this->created_by = \Yii::$app->user->identity->id;
        $this->created = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->db->createCommand()->update(
            'party_history',
            ['last' => 0, 'created' => date('Y-m-d H:i:s')],
            ['and', 'id != :id', 'party_id = :party_id'],
            [':id' => $this->id, ':party_id' => $this->party_id]
        )->execute();

        return parent::afterSave($insert, $changedAttributes);
    }
}
