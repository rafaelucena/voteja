<?php

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
            'short',
            'code',
            'description:ntext',
            'since',
            'active:boolean',
            [
                'label' => 'Created by',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        return Html::a(
                                $model->createdBy->person->firstname,
                                ['/person/view', 'id'=>$model->createdBy->person->id]
                            )  . ' (' . $model->created . ')';
                    }
                },
            ],
            [
                'label' => 'Updated by',
                'attribute' => 'updatedBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->updatedBy) {
                        return Html::a(
                                $model->updatedBy->person->firstname,
                                ['/person/view', 'id'=>$model->updatedBy->person->id]
                            )  . ' (' . $model->updated . ')';
                    }
                },
            ],
        ],
    ]) ?>

</div>
