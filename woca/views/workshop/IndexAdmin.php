<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\ToolsColumn;
use backend\modules\woca\models\LaporanWorkshopFile;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\woca\models\search\WorkshopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workshop';
$this->params['breadcrumbs'][] = ['label' => 'Workshop', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
$status_url = urldecode('IzinBermalamSearch%5Bstatus_request_id%5D');

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

<div class="workshop-index">

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
     //   'filterModel' => $searchModel,
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
            'judul_workshop',
            'tanggal_mulai',
            'tanggal_berakhir',
            'pembicara',
            'pelaksana',
            'laporan_workshop_id'=>[
                 'label' => 'File',
                // 'value' => 'Test',
                'value' => function($model){
                    $result = null;
                    $fileworkshop = LaporanWorkshopFile::find()->where(['laporan_workshop_id' => $model->laporan_workshop_id])->all();
                    foreach($fileworkshop as $data){                   
                         $result = $data->nama_file;
                    }
                    return Html::a($result,['workshop/download-admin','id'=>$model->laporan_workshop_id]);
                    //return $result;
                },
                 'format' => 'html',
                 
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
                        return Url::toRoute(['workshop-by-admin-view', 'id' => $key]);
                    }else if ($action === 'approve') {
                        return Url::toRoute(['approve-by-admin-index', 'workshop' => $model->workshop_id]);
                    }else if ($action === 'del') {
                        return Url::toRoute(['del', 'id' => $key]);
                    }else if ($action === 'reject') {
                        return Url::toRoute(['reject-by-admin-index', 'workshop' => $model->workshop_id]);
                     } 
                }
            ],

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
