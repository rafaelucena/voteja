<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\PictureType;

/* @var $this yii\web\View */
/* @var $model app\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form-fields">

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'picture_type_id')->textInput() ?>
    <?= Html::activeDropDownList($model, 'id',
        ArrayHelper::map(PictureType::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>