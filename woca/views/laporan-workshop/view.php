<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\LaporanWorkshopFile */

$this->title = $model->laporan_workshop_id;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Workshop Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-workshop-file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->laporan_workshop_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->laporan_workshop_id], [
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
            'laporan_workshop_id',
            'nama_file',
            'lokasi_file',
            'deleted',
            'deleted_at',
            'deleted_by',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
