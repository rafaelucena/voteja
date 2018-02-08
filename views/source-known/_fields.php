<?php

use yii\helpers\ArrayHelper;
use app\models\Trust;

/* @var $this yii\web\View */
/* @var $model app\models\SourceKnown */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-known-form-fields">

    <?= $form->field($model, 'trust_id')->label('Trust')->dropDownList(
        ArrayHelper::map(
            Trust::find()->all(),
            'id',
            function($model) {
                return $model['level'] . ' - ' . $model['name'];
            }
        )
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
