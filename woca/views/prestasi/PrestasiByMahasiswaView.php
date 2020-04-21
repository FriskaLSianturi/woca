<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\woca\models\StatusPeserta;
use backend\modules\woca\models\SertifikatFile;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Prestasi */

$this->title = "Detail Prestasi".' '. $model->nama_kompetisi;
$this->params['breadcrumbs'][] = ['label' => 'Prestasis', 'url' => ['prestasi-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_kompetisi',
            [
                'label' => 'Tingkatan',
                'value' => function($model){
                    $result = null;
                    $statuskompetisi = StatusPeserta::find()->where(['status_prestasi_id' => $model->status_prestasi_id ])->One();
                    $result = $statuskompetisi->status_prestasi_peserta;

                    return $result;
                }
            ],
            [
                    'label' => 'File Sertifikat',
                    'value' => function($model){
                        $result = null;
                        $sertifikat = SertifikatFile::find()->where(['prestasi_id' => $model->prestasi_id])->all();
                        foreach ($sertifikat as $data) {
                            # code...
                            $result .= $data->sertifikat_file;
                        }
                        return Html::a($result,['prestasi/download','id'=>$model->prestasi_id]);
                    },
                    'format'=>'html'
            ],
            'tahun',
            'pelaksana',
             
        ],
    ]) ?>

</div>
