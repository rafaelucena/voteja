<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistoryStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create History Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'active:boolean',
            'created_by',
            'updated_by',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
