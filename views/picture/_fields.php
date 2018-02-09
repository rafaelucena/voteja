<?php

use yii\helpers\Inputs;


/* @var $this yii\web\View */
/* @var $model app\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form-fields">

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= Inputs::pictureType($form, $model) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>