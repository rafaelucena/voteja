<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartyHistory */

$this->title = 'Update Party History: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Party Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="party-history-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
