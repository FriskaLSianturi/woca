<?php

use common\components\ToolsColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\woca\models\StatusPeserta;
use backend\modules\woca\models\SertifikatFile;
use dosamigos\highcharts\HighCharts;
use yii\helpers\Url;

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
        <?= Html::a('Workshop', ['workshop/index-admin'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Kompetisi', ['kompetisi/kompetisi-by-admin-index'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Prestasi', ['prestasi/prestasi-by-admin-index'], ['class' => 'btn btn-info']) ?>

        <?= Html::a('Export',['excel'], ['class' => 'btn btn-primary r'])?>



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
                    //$result = $statuskompetisi->status_prestasi_peserta;
                    foreach($statuskompetisi as $data){
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
                    return Html::a($result,['prestasi/download-admin','id'=>$model->prestasi_id]);
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
                'template' => '{view} {approve} {reject}',
                'header' => 'Aksi',
                'buttons' => [
                    'view' => function ($url, $model){
                        return ToolsColumn::renderCustomButton($url, $model, 'View Detail', 'fa fa-eye');
                    },
                    'reject' => function ($url, $model){
                        if ($model->status_kegiatan_id == 2 || $model->status_kegiatan_id == 3 || $model->status_kegiatan_id == 4) {
                            return "";
                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Reject', 'fa fa-times');
                        }
                    },
                    'approve' => function ($url, $model){
                        if ($model->status_kegiatan_id == 2 || $model->status_kegiatan_id == 3 || $model->status_kegiatan_id == 4) {
                            return "";


                        }else{
                            return ToolsColumn::renderCustomButton($url, $model, 'Approve', 'fa fa-check');
                        }
                    },

                ],
                'urlCreator' => function ($action, $model, $key, $index){
                    //     $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
                    if ($action === 'view') {
                        return Url::toRoute(['prestasi-by-admin-view', 'id' => $key]);
                    }else if ($action === 'approve') {
                        return Url::toRoute(['approve-by-admin-index', 'id' => $model->prestasi_id]);
                    }else if ($action === 'del') {
                        return Url::toRoute(['del', 'id' => $key]);
                    }else if ($action === 'reject') {
                        return Url::toRoute(['reject-by-admin-index', 'id' => $model->prestasi_id]);

                    }
                }
            ],
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
