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
 * @property int $updated_by
 * @property string $updated
 *
 * @property HistoryStatus $historyStatus
 * @property User $updatedBy
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
            [['party_id', 'history_status_id', 'changed', 'current', 'updated_by', 'updated'], 'required'],
            [['party_id', 'history_status_id', 'updated_by'], 'integer'],
            [['changed', 'current'], 'string'],
            [['last'], 'boolean'],
            [['updated'], 'safe'],
            [['history_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => HistoryStatus::className(), 'targetAttribute' => ['history_status_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'updated_by' => 'Updated By',
            'updated' => 'Updated',
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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
        $this->updated_by = \Yii::$app->user->identity->id;
        $this->updated = date('Y-m-d H:i:s');

        return parent::beforeSave($insert);
    }
}
