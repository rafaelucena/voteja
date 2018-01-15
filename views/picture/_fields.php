<?php
/* @var $this yii\web\View */
/* @var $model app\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'image')->fileInput() ?>

<?= $form->field($model, 'picture_type_id')->textInput() ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'active')->checkbox() ?>
