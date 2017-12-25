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

            // Id - standard-index 1.0
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:50px'],
            ],
            'avatar',
//            'name',
//            'short',
            'code',
            //'description:ntext',
            //'since',
            //'active:boolean',
            // Created - standard-index 1.0
            [
                'label' => 'Created',
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
            // Updated - standard-index 1.0
            [
                'label' => 'Updated',
                'attribute' => 'updatedBy.person.firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->updatedBy) {
                        return substr($model->created, 0, 10) . ' | ' . Html::a(
                            $model->updatedBy->person->firstname,
                            ['/person/view', 'id'=>$model->updatedBy->person->id]
                        );
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
