<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Prestasi */

$this->title = 'Tambah Prestasi';
$this->params['breadcrumbs'][] = ['label' => 'Prestasis', 'url' => ['prestasi-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formPrestasi', [
        'model' => $model,
        'model_status_peserta' => $model_status_peserta,
     
    ]) ?>

</div>
