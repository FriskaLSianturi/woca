<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Kompetisi */

$this->title = 'Tambah Data Kompetisi';
$this->params['breadcrumbs'][] = ['label' => 'Kompetisi', 'url' => ['kompetisi-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kompetisi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formKompetisi', [
        'model' => $model,
        'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
    ]) ?>

</div>
