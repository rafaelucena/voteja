<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HistoryStatus */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'History Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
