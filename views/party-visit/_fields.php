<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartyVisit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="party-visit-form-fields">

    <?= $form->field($model, 'visit_id')->textInput() ?>

    <?= $form->field($model, 'party_id')->textInput() ?>

</div>
