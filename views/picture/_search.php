<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PictureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'picture_type_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'alt') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
