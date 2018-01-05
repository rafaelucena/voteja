<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UploadForm */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Upload', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
