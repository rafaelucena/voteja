<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartyVisit */

$this->title = 'Update Party Visit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Party Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="party-visit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
