<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VisitType */

$this->title = 'Create Visit Type';
$this->params['breadcrumbs'][] = ['label' => 'Visit Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
