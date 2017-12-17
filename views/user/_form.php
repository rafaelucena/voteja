<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $userModel app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($userModel, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($userModel, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($userModel, 'blocked')->checkbox() ?>

    <?= $form->field($userModel, 'active')->checkbox() ?>

    <?= $form->field($userModel, 'created_by')->textInput() ?>

    <?= $form->field($userModel, 'updated_by')->textInput() ?>

    <?= $form->field($userModel, 'deleted_by')->textInput() ?>

    <?= $form->field($userModel, 'created')->textInput() ?>

    <?= $form->field($userModel, 'updated')->textInput() ?>

    <?= $form->field($userModel, 'deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
