<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Party */
/* @var $modelPicture app\models\Picture */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPicture' => $modelPicture,
    ]) ?>

</div>
