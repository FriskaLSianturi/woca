<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\woca\models\search\PesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'peserta_id',
            'kompetisi_id',
            'dim_id',
            'deleted',
            'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'update_at',
            // 'update_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
