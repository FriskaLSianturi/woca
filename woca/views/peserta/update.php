<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Peserta */

$this->title = 'Update Peserta: ' . ' ' . $model->peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peserta_id, 'url' => ['view', 'id' => $model->peserta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peserta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
