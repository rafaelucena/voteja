<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartyHistory */

$this->title = 'Create Party History';
$this->params['breadcrumbs'][] = ['label' => 'Party Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
