<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "party_source".
 *
 * @property int $id
 * @property int $party_id
 * @property int $source_id
 * @property bool $last
 *
 * @property Source $source
 * @property Party $party
 */
class PartySource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'party_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['party_id', 'source_id'], 'required'],
            [['party_id', 'source_id'], 'integer'],
            [['last'], 'boolean'],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['source_id' => 'id']],
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
            'source_id' => 'Source ID',
            'last' => 'Last',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Source::className(), ['id' => 'source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParty()
    {
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }
}
