<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VisitType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visit-type-form-fields">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
