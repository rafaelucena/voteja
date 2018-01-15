<?php

use yii\helpers\Attributes;
use yii\helpers\Html;
use yii\helpers\Url;

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
            Attributes::index('id'),
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->partyPicture) {
                        $fileName = implode('.', [$model->partyPicture->name, $model->partyPicture->extension]);

                        return Html::img("@web/images/party/$fileName", ['width' => '75px', 'height' => '50px']);
                    }
                },
            ],
//            'picture_id',
            //'address_id',
            //'name',
            'number',
            'code',
            //'description:ntext',
            //'since',
            //'until',
            //'active:boolean',
            // Created
            Attributes::index('created'),
            // Updated
            Attributes::index('updated'),

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'rowOptions' => function ($model) {
            return [
                'data-id' => $model['id']
            ];
        },
    ]); ?>
</div>

<?php
$this->registerJs("
    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this) {
            location.href = '" . Url::to(['party/display']) . "&id=' + id;
        }
    });
");
?>