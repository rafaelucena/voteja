<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartySource */

$this->title = 'Create Party Source';
$this->params['breadcrumbs'][] = ['label' => 'Party Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
