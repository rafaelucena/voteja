<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartyHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Party History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Party History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
//            'current:ntext',
            'changed:ntext',
            'last:boolean',
            [
                'label' => 'Updated',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        return substr($model->created, 0, 10) . ' | ' . Html::a(
                                $model->createdBy->person->firstname,
                                ['/person/view', 'id'=>$model->createdBy->person->id]
                            );
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
