<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\woca\models\search\LaporanWorkshopFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Workshop Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-workshop-file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Laporan Workshop File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'laporan_workshop_id',
            'nama_file',
            'lokasi_file',
            'deleted',
            'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
