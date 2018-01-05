<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PictureType */

$this->params['breadcrumbs'][] = ['label' => 'Picture Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->title = 'Update: ' . $model->id . ' - ' . $model->name;
?>
<div class="picture-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
