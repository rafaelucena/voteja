<?php

namespace app\models;

use function GuzzleHttp\Psr7\mimetype_from_filename;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "picture".

 * Attributes section
 * @property int $id
 * @property int $picture_type_id
 * @property string $name
 * @property string $extension
 * @property string $alt
 * @property int $size
 * @property bool $active
 * @property string $hash
 * @property int $created_by
 * @property int $updated_by
 * @property string $created
 * @property string $updated
 * @property string $checked

 * Relations section
 * @property PictureType $pictureType
 * @property User $createdBy
 * @property User $updatedBy
 */
class Picture extends \yii\db\ActiveRecord
{
    public $image;

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
            [['picture_type_id', 'name'/*, 'created_by', 'created'*/], 'required'],
            [['picture_type_id', 'size', 'created_by', 'updated_by'], 'integer'],
            [['active'], 'boolean'],
            [['created', 'updated', 'checked'], 'safe'],
            [['name', 'hash'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 15],
            [['alt'], 'string', 'max' => 127],
            [['picture_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PictureType::className(), 'targetAttribute' => ['picture_type_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'extension' => 'Extension',
            'alt' => 'Alt',
            'size' => 'Size',
            'active' => 'Active',
            'hash' => 'Hash',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'Checked' => 'Checked',
        ];
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

    /**
     *
     */
    public function afterFind()
    {
        $fullPath = $this->getFullPath();

        if (!$this->checkPicture($fullPath)) {
            if ($this->hash) {
                $directory = $this->hash[0];
                $source = implode('/', [Url::to('@app/web/files'), $directory, $this->hash]);

                $destination = implode('/', [Url::to('@app/web/images/party'), 'pmdb.jpg']);

                if (copy($source, $destination)) {
                    $this->checked = date( 'Y-m-d H:i:s', filectime($destination));
                    $this->save();
                }
            }
        }

        return parent::afterFind();
    }

    /**
     * @return string
     */
    private function getFullPath()
    {
        $local = Url::to('@app/web/images/party/');

        $fileName = $local . implode('.', [$this->name, $this->extension]);

        return $fileName;
    }

    /**
     * @param $fullPath
     * @return bool
     */
    public function checkPicture($fullPath)
    {
        if (file_exists($fullPath)) {
            $modified = filectime($fullPath);

            if ($modified == strtotime($this->checked)) {
                if (($modified + 60*15) >= time()) {
                    return true;
                }
            }
        }

        return false;
    }
}
