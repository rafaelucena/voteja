<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Source */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-form">

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
