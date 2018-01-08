<?php

use yii\helpers\Attributes;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Picture */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Picture', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'View: ' . $this->title . ' - ' . $model->name;
?>
<div class="picture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        echo Html::img('@web/images/party/pmdb.jpg');
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => '',
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    $fileName = $model->image = implode('.', [$model->name, $model->extension]);

                    return Html::img("@web/images/party/$fileName");
                },
            ],
            'picture_type_id',
            'name',
            'local',
            'extension',
            'alt',
            'size',
            'active:boolean',
            'hash',
            // Created
            Attributes::view('created'),
            // Updated
            Attributes::view('updated'),
        ],
    ]) ?>

</div>
