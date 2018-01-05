<?php

use yii\helpers\Attributes;
use yii\helpers\Html;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Picture';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Picture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // Id
            Attributes::index('id'),
            'picture_type_id',
            'name',
            'local',
            'extension',
            //'alt',
            //'size',
            //'active:boolean',
            //'hash',
            // Created
            Attributes::index('created'),
            // Updated
            Attributes::index('updated'),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
