<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Party */
/* @var $modelPicture app\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="picture-form-section">
        <?php /** PICTURE SECTION **/ ?>

        <?= $form->field($modelPicture, 'image')->fileInput() ?>

        <?= $form->field($modelPicture, 'picture_type_id')->textInput() ?>

        <?= $form->field($modelPicture, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelPicture, 'alt')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelPicture, 'active')->checkbox() ?>
    </div>

    <div class="party-form-section">
        <?php /** PARTY SECTION **/ ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'since')->textInput() ?>

        <?= $form->field($model, 'until')->textInput() ?>

        <?= $form->field($model, 'active')->checkbox() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
