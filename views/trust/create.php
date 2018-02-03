<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Trust */

$this->title = 'Create Trust';
$this->params['breadcrumbs'][] = ['label' => 'Trusts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trust-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
