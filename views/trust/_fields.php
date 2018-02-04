<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Trust */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trust-form-fields">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
