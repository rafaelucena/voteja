<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $person_id
 * @property string $username
 * @property string $password
 * @property string $token
 * @property bool $blocked
 * @property bool $active
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property string $created
 * @property string $updated
 * @property string $deleted
 *
 * @property Address[] $addresses
 * @property City[] $cities
 * @property Country[] $countries
 * @property Permission[] $permissions
 * @property Permission[] $permissions0
 * @property Permission[] $permissions1
 * @property Person[] $people
 * @property Person[] $people0
 * @property Person[] $people1
 * @property Role[] $roles
 * @property Role[] $roles0
 * @property Role[] $roles1
 * @property RolePermission[] $rolePermissions
 * @property RolePermission[] $rolePermissions0
 * @property RolePermission[] $rolePermissions1
 * @property State[] $states
 * @property User $deletedBy
 * @property User[] $users
 * @property User $updatedBy
 * @property User[] $users0
 * @property User $createdBy
 * @property User[] $users1
 * @property Person $person
 * @property UserRole[] $userRoles
 * @property UserRole[] $userRoles0
 * @property UserRole[] $userRoles1
 * @property UserRole[] $userRoles2
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'created'], 'required'],
            [['person_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['blocked', 'active'], 'boolean'],
            [['created', 'updated', 'deleted'], 'safe'],
            [['username'], 'string', 'max' => 31],
            [['password', 'token'], 'string', 'max' => 255],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deleted_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'username' => 'Username',
            'password' => 'Password',
            'token' => 'Token',
            'blocked' => 'Blocked',
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
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions0()
    {
        return $this->hasMany(Permission::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions1()
    {
        return $this->hasMany(Permission::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople0()
    {
        return $this->hasMany(Person::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople1()
    {
        return $this->hasMany(Person::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles0()
    {
        return $this->hasMany(Role::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles1()
    {
        return $this->hasMany(Role::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermissions()
    {
        return $this->hasMany(RolePermission::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermissions0()
    {
        return $this->hasMany(RolePermission::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePermissions1()
    {
        return $this->hasMany(RolePermission::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['created_by' => 'id']);
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
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['deleted_by' => 'id']);
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
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['updated_by' => 'id']);
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
    public function getUsers1()
    {
        return $this->hasMany(User::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles0()
    {
        return $this->hasMany(UserRole::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles1()
    {
        return $this->hasMany(UserRole::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles2()
    {
        return $this->hasMany(UserRole::className(), ['user_id' => 'id']);
    }
}
