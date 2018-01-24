<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartyVisit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-visit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('_fields', [
        'form' => $form,
        'model' => $model,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>