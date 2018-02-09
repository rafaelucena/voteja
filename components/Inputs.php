<?php

namespace yii\helpers;

use app\models\PictureType;

use yii\db\ActiveRecord;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;

class Inputs extends Common
{
    /**
     * @param ActiveForm $form
     * @param ActiveRecord $model
     * @return ActiveField $field
     */
    static public function pictureType($form, $model)
    {
        $field = $form->field($model, 'picture_type_id')->label('Picture type')->dropDownList(
            ArrayHelper::map(
                PictureType::find()->all(),
                'id',
                'name'
            )
        );

        return $field;
    }
}
