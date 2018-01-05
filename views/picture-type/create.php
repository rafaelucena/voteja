<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PictureType */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Picture Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
