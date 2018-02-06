<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source_known".
 *
 * @property int $id
 * @property int $trust_id
 * @property string $name
 * @property string $url
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated
 *
 * @property Source[] $sources
 * @property User $updatedBy
 * @property User $createdBy
 * @property Trust $trust
 */
class SourceKnown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_known';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trust_id', 'name', 'url'/*, 'created_by', 'created'*/], 'required'],
            [['trust_id', 'created_by', 'updated_by'], 'integer'],
            [['active'], 'boolean'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 31],
            [['url'], 'string', 'max' => 127],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['trust_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trust::className(), 'targetAttribute' => ['trust_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trust_id' => 'Trust ID',
            'name' => 'Name',
            'url' => 'Url',
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
    public function getSources()
    {
        return $this->hasMany(Source::className(), ['source_known_id' => 'id']);
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
    public function getTrust()
    {
        return $this->hasOne(Trust::className(), ['id' => 'trust_id']);
    }
}
