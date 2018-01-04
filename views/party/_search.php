<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'picture_id') ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'since') ?>

    <?php // echo $form->field($model, 'until') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
