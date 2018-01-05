<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture_type".

 * Attributes section
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated

 * Relations section
 * @property User $updatedBy
 * @property User $createdBy
 */
class PictureType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'/*, 'created_by', 'created'*/], 'required'],
            [['active'], 'boolean'],
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
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        if ($insert) {
            $this->created_by = \Yii::$app->user->identity->id;
            $this->created = date('Y-m-d H:i:s');
        } else {
            $this->updated_by = \Yii::$app->user->identity->id;
            $this->updated = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }
}
