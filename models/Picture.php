<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $id
 * @property int $picture_type_id
 * @property string $name
 * @property string $local
 * @property string $extension
 * @property string $alt
 * @property int $size
 * @property bool $active
 * @property string $hash
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated
 *
 * @property Party[] $parties
 * @property PictureType $pictureType
 * @property User $updatedBy
 * @property User $createdBy
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture_type_id', 'name', 'created_by', 'created'], 'required'],
            [['picture_type_id', 'size', 'created_by', 'updated_by'], 'integer'],
            [['active'], 'boolean'],
            [['created', 'updated'], 'safe'],
            [['name', 'local', 'hash'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 15],
            [['alt'], 'string', 'max' => 127],
            [['picture_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PictureType::className(), 'targetAttribute' => ['picture_type_id' => 'id']],
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
            'picture_type_id' => 'Picture Type ID',
            'name' => 'Name',
            'local' => 'Local',
            'extension' => 'Extension',
            'alt' => 'Alt',
            'size' => 'Size',
            'active' => 'Active',
            'hash' => 'Hash',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParties()
    {
        return $this->hasMany(Party::className(), ['picture_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictureType()
    {
        return $this->hasOne(PictureType::className(), ['id' => 'picture_type_id']);
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
}
