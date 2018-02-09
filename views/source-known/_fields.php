<?php

use yii\helpers\Inputs;

/* @var $this yii\web\View */
/* @var $model app\models\SourceKnown */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-known-form-fields">

    <?= Inputs::trust($form, $model) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
