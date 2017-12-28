<?php

use yii\helpers\Data;
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

            // Id
            Data::index('id'),
            // Party
            Data::general('party'),
            // Status
            Data::general('status'),
            [
                'attribute' => 'changed',
                'value' => function ($model) {
                    if ($model->changed) {
                        if (strlen($model->changed) > 100) {
                            return substr($model->changed, 0, 97) . ' ... }';
                        } else {
                            return $model->changed;
                        }
                    }
                },
            ],
//            'current:ntext',
            //'active:boolean',
            'last:boolean',
            // Created
            Data::index('created'),
            //'updated_by',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
