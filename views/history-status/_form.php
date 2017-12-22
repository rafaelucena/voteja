<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-status-form">
    <?php
        $form = ActiveForm::begin();

        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'active')->checkbox();
//        echo $form->field($model, 'created_by')->textInput();
//        echo $form->field($model, 'updated_by')->textInput();
//        echo $form->field($model, 'created')->textInput();
//        echo $form->field($model, 'updated')->textInput();
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
