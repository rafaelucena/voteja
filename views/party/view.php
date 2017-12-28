<?php

use yii\helpers\Data;
use yii\helpers\Html;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Party */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'View: ' . $this->title . ' - ' . $model->code;
?>
<div class="party-view">

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
            'avatar',
            'name',
            'number',
            'code',
            'url_keys:url',
            'description:ntext',
            'since',
            'until',
            'active:boolean',
            // Created
            Data::view('created'),
            // Updated
            Data::view('updated'),
        ],
    ]) ?>

</div>
