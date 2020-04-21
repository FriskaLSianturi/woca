<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\LaporanWorkshopFile */

$this->title = 'Update Laporan Workshop File: ' . ' ' . $model->laporan_workshop_id;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Workshop Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->laporan_workshop_id, 'url' => ['view', 'id' => $model->laporan_workshop_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laporan-workshop-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
