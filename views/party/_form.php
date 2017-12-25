<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Party */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_keys')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'since')->textInput() ?>

    <?= $form->field($model, 'until')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?php //echo $form->field($model, 'created_by')->textInput() ?>

    <?php //echo $form->field($model, 'updated_by')->textInput() ?>

    <?php //echo $form->field($model, 'created')->textInput() ?>

    <?php //echo $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
