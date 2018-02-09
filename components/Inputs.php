<?php

namespace yii\helpers;

use app\models\PictureType;
use app\models\Trust;

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

    /**
     * @param ActiveForm $form
     * @param ActiveRecord $model
     * @return ActiveField $field
     */
    static public function trust($form, $model)
    {
        $field = $form->field($model, 'trust_id')->label('Trust')->dropDownList(
            ArrayHelper::map(
                Trust::find()->all(),
                'id',
                function($model) {
                    return $model['level'] . ' - ' . $model['name'];
                }
            )
        );

        return $field;
    }
}
