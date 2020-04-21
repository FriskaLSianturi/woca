<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Workshop */

$this->title = 'Edit Data '.$model->judul_workshop;
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index-mahasiswa']];
$this->params['breadcrumbs'][] = ['label' => $model->workshop_id, 'url' => ['workshop-by-mahasiswa-edit', 'id' => $model->workshop_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workshop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditWorkshop', [
        'model' => $model,
        'modelLampiran' => $modelLampiran,            
    ]) ?>

</div>
