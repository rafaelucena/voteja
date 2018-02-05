<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source".
 *
 * @property int $id
 * @property int $source_known_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $when
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property string $created
 * @property string $updated
 * @property string $deleted
 *
 * @property PartySource[] $partySources
 * @property SourceKnown $sourceKnown
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $deletedBy
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_known_id'/*, 'created_by', 'created'*/], 'required'],
            [['source_known_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['when', 'created', 'updated', 'deleted'], 'safe'],
            [['active'], 'boolean'],
            [['title'], 'string', 'max' => 63],
            [['description'], 'string', 'max' => 127],
            [['url'], 'string', 'max' => 511],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deleted_by' => 'id']],
            [['source_known_id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceKnown::className(), 'targetAttribute' => ['source_known_id' => 'id']],
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
            'source_known_id' => 'Source Known ID',
            'title' => 'Title',
            'description' => 'Description',
            'url' => 'Url',
            'when' => 'When',
            'active' => 'Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartySources()
    {
        return $this->hasMany(PartySource::className(), ['source_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceKnown()
    {
        return $this->hasOne(SourceKnown::className(), ['id' => 'source_known_id']);
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
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }
}
