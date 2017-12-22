<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Party';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Party', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'avatar',
//            'name',
//            'short',
            'code',
            //'description:ntext',
            //'since',
            //'active:boolean',
            [
                'label' => 'Created by',
                'attribute' => 'createdBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->createdBy) {
                        return Html::a(
                            $model->createdBy->person->firstname,
                            ['/person/view', 'id'=>$model->createdBy->person->id]
                        ) . ' (' . $model->created . ')';
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
                        ) . ' (' . $model->updated . ')';
                    }
                },
            ],
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
