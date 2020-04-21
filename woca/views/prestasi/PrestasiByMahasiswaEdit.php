<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Prestasi */

$this->title = 'Update Prestasi ' . ' ' . $model->nama_kompetisi;
$this->params['breadcrumbs'][] = ['label' => $model->prestasi_id, 'url' => ['workshop-by-mahasiswa-view', 'id' => $model->prestasi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdatePrestasi', [
        'model' => $model,
        'model_status_peserta' => $model_status_peserta,
        'modelLampiran' => $modelLampiran,
    ]) ?>

</div>
