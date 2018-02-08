<?php

use yii\helpers\ArrayHelper;
use app\models\SourceKnown;

/* @var $this yii\web\View */
/* @var $model app\models\Source */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-form-fields">

    <?= $form->field($model, 'source_known_id')->label('Source known')->dropDownList(
        ArrayHelper::map(
            SourceKnown::find()->all(),
            'id',
            'name'
        )
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'when')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
