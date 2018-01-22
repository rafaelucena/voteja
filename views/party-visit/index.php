<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartyVisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Party Visits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-visit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Party Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'visit_id',
            'party_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
