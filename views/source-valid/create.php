<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SourceValid */

$this->title = 'Create Source Valid';
$this->params['breadcrumbs'][] = ['label' => 'Source Valids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-valid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
