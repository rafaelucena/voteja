<?php

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
            [
                'label' => 'Party',
                'attribute' => 'party.code',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->party) {
                        return Html::a(
                            $model->party->code,
                            ['/party/view', 'id'=>$model->party->id]
                        );
                    }
                },
            ],
            [
                'label' => 'Status',
                'attribute' => 'historyStatus.name',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->historyStatus) {
                        return Html::a(
                            $model->historyStatus->name,
                            ['/history-status/view', 'id'=>$model->historyStatus->id]
                        );
                    }
                },
            ],
            'changed:ntext',
            'current:ntext',
            'active:boolean',
            'last:boolean',
            [
                'label' => 'Created',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        return $model->created . ' | ' . Html::a(
                            $model->createdBy->person->firstname,
                            ['/person/view', 'id'=>$model->createdBy->person->id]
                        );
                    }
                },
            ],
            'updated_by',
            'updated',
        ],
    ]) ?>

</div>
