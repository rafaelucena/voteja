<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartyVisit */

$this->title = 'Create Party Visit';
$this->params['breadcrumbs'][] = ['label' => 'Party Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-visit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
