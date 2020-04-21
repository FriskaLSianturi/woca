<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\woca\models\Peserta;
use backend\modules\woca\models\ProposalKompetisiFile;
use backend\modules\woca\models\TingkatanKompetisi;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Kompetisi */

$this->title = $model->nama_kompetisi;
$this->params['breadcrumbs'][] = ['label' => 'Kompetisi', 'url' => ['kompetisi-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kompetisi-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ 
            'nama_kompetisi',
            'tahun',
            'penyelenggara',
            'deskripsi',
            [
                'label' => 'Tingkatan',
                'value' => function($model){
                    $result = null;
                    $file = TingkatanKompetisi::find()->where(['tingkatan_kompetisi_id' => $model->tingkatan_kompetisi_id])->all();
                    foreach($file as $data){
                        // echo"<pre>"; print_r($data->lokasi->nama_lokasi); die();
                        $result .= $data->tingkatan. "<br>";
                        //$result .= $data->nama . "<br>";
                       // die();
                    }
                       

                    return $result;
                },
                'format' => 'html',
            ],
            [
                //'attribute' => 'name',
                'label' => 'File Proposal',
                'format' => 'raw',
                'value' => function($model){
                    $result = null;
                    $file = ProposalKompetisiFile::find()->where(['kompetisi_id' => $model->kompetisi_id])->all();
                    foreach($file as $data){
                        $result .= $data->file_proposal. "<br>";
                    }

                    return Html::a($result, ['kompetisi/download-admin', 'id'=>$model->kompetisi_id]);
                },

            ],
                'jumlah_peserta',
                [
                    'label' => 'Daftar Peserta',
                    'value' => function($model){
                        $result = null;
                        $peserta = Peserta::find()->where(['kompetisi_id' => $model->kompetisi_id])->all();
                        foreach($peserta as $data){
                            // echo"<pre>"; print_r($data->lokasi->nama_lokasi); die();
                            $result .= $data->dim->nama . "<br>";
                            //$result .= $data->nama . "<br>";
                        }

                        return $result;
                    },
                    'format' => 'html',
                ],

        ],
    ]) ?>

</div>
