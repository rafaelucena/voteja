<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party_visit".
 *
 * @property int $id
 * @property int $visit_id
 * @property int $party_id
 * @property int $visit_type_id
 * @property bool $last
 *
 * @property Party $party
 * @property Visit $visit
 */
class PartyVisit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party_visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visit_id', 'party_id', 'visit_type_id'], 'required'],
            [['visit_id', 'party_id', 'visit_type_id'], 'integer'],
            [['last'], 'boolean'],
            [['party_id'], 'exist', 'skipOnError' => true, 'targetClass' => Party::className(), 'targetAttribute' => ['party_id' => 'id']],
            [['visit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visit::className(), 'targetAttribute' => ['visit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visit_id' => 'Visit ID',
            'party_id' => 'Party ID',
            'visit_type_id' => 'Visit Type ID',
            'last' => 'Last',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisit()
    {
        return $this->hasOne(Visit::className(), ['id' => 'visit_id']);
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
                'party_visit',
                ['last' => 0],
                ['and', 'id != :id', 'party_id = :party_id', 'last = 1'],
                [':id' => $this->id, ':party_id' => $this->party_id]
            )->execute();
        }

        return parent::afterSave($insert, $changedAttributes);
    }
}
