<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SourceKnown */

$this->title = 'Create Source Known';
$this->params['breadcrumbs'][] = ['label' => 'Source Known', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-known-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
