<?php

use yii\helpers\Data;
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

            // Id
            Data::index('id'),
            'avatar',
//            'name',
            'number',
            'code',
            //'url_keys:url',
            //'description:ntext',
            //'since',
            //'until',
            //'active:boolean',
            // Created
            Data::index('created'),
            // Updated
            Data::index('updated'),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
