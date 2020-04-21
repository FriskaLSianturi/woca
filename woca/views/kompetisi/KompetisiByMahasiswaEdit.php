<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Kompetisi */

$this->title = 'Edit Kompetisi: ' . ' ' . $model->nama_kompetisi;
$this->params['breadcrumbs'][] = ['label' => 'Kompetisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kompetisi_id, 'url' => ['view', 'id' => $model->kompetisi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kompetisi-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo "test";?>
    <?= $this->render('_formUpdate', [
        'model' => $model,
        'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
        'modelLampiran' => $modelLampiran,
    ]) ?>

</div>
