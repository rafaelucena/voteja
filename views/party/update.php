<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Party */
/* @var $modelPicture app\models\Picture */

$this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->title = 'Update: ' . $model->id . ' - ' . $model->code;
?>
<div class="party-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPicture' => $modelPicture,
    ]) ?>

</div>
