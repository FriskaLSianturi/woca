<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Peserta */

$this->title = $model->peserta_id;
$this->params['breadcrumbs'][] = ['label' => 'Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peserta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->peserta_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->peserta_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'peserta_id',
            'kompetisi_id',
            'dim_id',
            'deleted',
            'deleted_at',
            'deleted_by',
            'created_at',
            'created_by',
            'update_at',
            'update_by',
        ],
    ]) ?>

</div>
