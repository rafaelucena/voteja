<?php

use yii\helpers\Attributes;
use yii\helpers\Html;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PartyHistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Party History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-history-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            Attributes::general('party'),
            // Status
            Attributes::general('status'),
            'changed:ntext',
            'current:ntext',
            'active:boolean',
            'last:boolean',
            // Created
            Attributes::view('created'),
            // Updated
            Attributes::view('updated'),

        ],
    ]) ?>

</div>
