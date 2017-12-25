<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartyHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'party_id')->textInput() ?>

    <?= $form->field($model, 'history_status_id')->textInput() ?>

    <?= $form->field($model, 'changed')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last')->checkbox() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
