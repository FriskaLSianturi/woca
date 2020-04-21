<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\LaporanWorkshopFile */

$this->title = 'Create Laporan Workshop File';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Workshop Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-workshop-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
