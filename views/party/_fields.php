<?php
/* @var $this yii\web\View */
/* @var $model app\models\Party */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-form-fields">

    <?php //echo $form->field($model, 'picture_id')->textInput() ?>

    <?php //echo $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'since')->textInput() ?>

    <?= $form->field($model, 'until')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

</div>
