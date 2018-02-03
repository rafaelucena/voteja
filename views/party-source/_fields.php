<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartySource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-source-form-fields">

    <?= $form->field($model, 'party_id')->textInput() ?>

    <?= $form->field($model, 'source_id')->textInput() ?>

    <?= $form->field($model, 'last')->checkbox() ?>

</div>
