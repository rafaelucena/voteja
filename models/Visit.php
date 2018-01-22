<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int $visit_type_id
 * @property int $count
 * @property string $date
 * @property string $last
 *
 * @property PartyVisit[] $partyVisit
 * @property VisitType $visitType
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visit_type_id', 'count', 'date', 'last'], 'required'],
            [['visit_type_id', 'count'], 'integer'],
            [['date', 'last'], 'safe'],
            [['visit_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => VisitType::className(), 'targetAttribute' => ['visit_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visit_type_id' => 'Visit Type ID',
            'count' => 'Count',
            'date' => 'Date',
            'last' => 'Last',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartyVisit()
    {
        return $this->hasMany(PartyVisit::className(), ['visit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitType()
    {
        return $this->hasOne(VisitType::className(), ['id' => 'visit_type_id']);
    }
}
