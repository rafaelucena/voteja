<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SourceKnownSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Source Known';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-known-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Source Known', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trust_id',
            'name',
            'url:url',
            'active:boolean',
            //'created_by',
            //'updated_by',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
