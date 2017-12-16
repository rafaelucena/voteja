<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $short
 * @property bool $sex
 * @property string $birthday
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property string $created
 * @property string $updated
 * @property string $deleted
 *
 * @property User $deletedBy
 * @property User $updatedBy
 * @property User $createdBy
 * @property User[] $users
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex'], 'boolean'],
            [['birthday', 'created', 'updated', 'deleted'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created'], 'required'],
            [['firstname', 'short'], 'string', 'max' => 31],
            [['lastname'], 'string', 'max' => 127],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deleted_by' => 'id']],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'short' => 'Short',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
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
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
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
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['person_id' => 'id']);
    }
}
