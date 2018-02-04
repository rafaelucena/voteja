<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trust */

$this->params['breadcrumbs'][] = ['label' => 'Trust', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->title = 'Update: ' . $model->id . ' - ' . $model->name;
?>
<div class="trust-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
