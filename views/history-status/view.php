<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryStatus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'History Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = $this->title . ' - ' . $model->name;
?>
<div class="history-status-view">

    <h1>View: <?=  Html::encode($this->title) ?></h1>

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
            'name',
            'active:boolean',
            [
//                'label' => 'Created by',
//                'value' => $model->createdBy->person->firstname,
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
//                'label' => 'Updated by',
//                'value' => $model->updatedBy->person->firstname,
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
//            'created',
//            'updated',
        ],
    ]) ?>

</div>
