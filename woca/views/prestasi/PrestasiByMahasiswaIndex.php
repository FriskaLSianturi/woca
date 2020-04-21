<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\ToolsColumn;
use backend\modules\woca\models\StatusPeserta;
use backend\modules\woca\models\SertifikatFile;
use dosamigos\highcharts\HighCharts;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\woca\models\search\PrestasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestasi';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
  .CustomClass table thead {
   color:  #3c8dbc;
    }
  .marginp{
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .r{
      margin-left: 450px;
  }

</style>
<div class="prestasi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p class="marginp">
        <?= Html::a('Workshop', ['workshop/index-mahasiswa'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Kompetisi', ['kompetisi/kompetisi-by-mahasiswa-index'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Prestasi', ['prestasi/prestasi-by-mahasiswa-index'], ['class' => 'btn btn-info']) ?>

        <?= Html::a('Tambah Prestasi', ['prestasi/prestasi-by-mahasiswa-add'], ['class' => 'btn btn-success r']) ?>
     </p>
    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'options' => [
              'class' => 'CustomClass',
         ],
        'rowOptions' => function($model){
            if($model->status_kegiatan_id == 1){
                return ['class' => 'info'];
            } else if($model->status_kegiatan_id == 2){
                return ['class' => 'success'];
            } else if($model->status_kegiatan_id == 3){
                return ['class' => 'danger'];
            } else {
                return ['class' => 'warning'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_kompetisi',
            'tahun',
            [
                'label' => 'Pelaksana',
                'value' => 'pelaksana',
            ],
            [
                'label' => 'Pencapaian Prestasi',
                'value' => function($model){
                    $result = null;
                    $statuskompetisi = StatusPeserta::find()->where(['status_prestasi_id' => $model->status_prestasi_id ])->All();
                    foreach ($statuskompetisi as $data){
                        $result .= $data->status_prestasi_peserta;
                    }
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
                    return Html::a($result,['prestasi/download-mahasiswa','id'=>$model->prestasi_id]);
                },
                'format'=>'html'
            ],
            [
                'attribute' => 'status_kegiatan_id',
                'label' => 'Status Permohonan',
                'value' => function($model){
                    if($model->status_kegiatan_id == 1){
                        return "Requested";
                    }elseif($model->status_kegiatan_id == 2){
                        return "Accepted";
                    }elseif ($model->status_kegiatan_id == 3) {
                        return "Rejected";
                    }elseif($model->status_kegiatan_id == 4){
                        return "Canceled";
                    }
                },
            ],
            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit} {cancel}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'cancel' => function ($url, $model){
                        if ($model->status_kegiatan_id == 2 || $model->status_kegiatan_id == 3 || $model->status_kegiatan_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Cancel', 'fa fa-times');
                        }
                    },
                    'edit' => function ($url, $model){
                        if ($model->status_kegiatan_id == 2 || $model->status_kegiatan_id == 3 || $model->status_kegiatan_id == 4) {
                            return "";
                        } else {
                            return ToolsColumn::renderCustomButton($url, $model, 'Edit', 'fa fa-pencil');
                        }
                    },

                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['prestasi-by-mahasiswa-view', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['prestasi-by-mahasiswa-edit', 'id' => $key]);
                    }else if ($action === 'cancel') {
                        return Url::toRoute(['cancel-by-mahasiswa', 'id' => $key]);
                    }
                    // else if($action === 'download'){

                    //     return Url::toRoute(['download', 'id' => $model->laporan_workshop_id]);
                    // }
                }
            ],
         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="x_panel">
                    <div id="my-chart" style="min-width: 310px; height: 400px; margin-left: : -100 auto">
                        <?php

                        $this->title = 'Prestasi Mahasiswa';

                        foreach ($dgrafik as $values) {
                            # code...
                            // $a[0] = ($values['status_prestasi_id']);
                            // $c[] = ($values['status_prestasi_id']);
                            // $b[] = array('type' => 'column', 'name' => $values['tahun'], 'data' => [array((int)$values['Juara1']), array((int)$values['Juara2']), array((int)$values['Juara3']), array((int)$values['JuaraH1']), array((int)$values['JuaraH2'])]);
                            $b[] = array('type' => 'column',
                                'name' => $values['tahun'], 'data' => array((int)$values['jlhperthn'])
                            );
                        }

                        echo HighCharts::widget([
                            'clientOptions' => [
                                'chart' => [
                                    'type' => 'column'
                                ],
                                'title' => [
                                    'text' => 'Data Prestasi Mahasiswa'
                                ],
                                'xAxis' => [
                                    'categories' => [
                                        '',
                                    ]
                                ],
                                'yAxis' => [
                                    'title' => [
                                        'text' => 'Jumlah Capaian Prestasi per Tahun'
                                    ]
                                ],
                                'series' => $b
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
