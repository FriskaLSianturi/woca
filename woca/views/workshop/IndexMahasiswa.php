<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\components\ToolsColumn;
use common\helpers\LinkHelper;
use backend\modules\woca\models\LaporanWorkshopFile;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\woca\models\search\WorkshopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workshop';
$this->params['breadcrumbs'][] = ['label' => 'Workshop', 'url' => ['index-mahasiswa']];

 

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
  .btnm{
    margin-left: 13px;
  }
</style>

<div class="workshop-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="marginp">
        <?= Html::a('Workshop', ['workshop/index-mahasiswa'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Kompetisi', ['kompetisi/kompetisi-by-mahasiswa-index'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Prestasi', ['prestasi/prestasi-by-mahasiswa-index'], ['class' => 'btn btn-info']) ?>

        <?= Html::a('Tambah Workshop', ['workshop/workshop-by-mahasiswa-add'], ['class' => 'btn btn-success r']) ?>

    </p>
    

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
                    return Html::a($result,['workshop/download-mahasiswa','id'=>$model->laporan_workshop_id]);
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
                        return Url::toRoute(['workshop-by-mahasiswa-view', 'id' => $key]);
                    }else if ($action === 'edit') {
                        return Url::toRoute(['workshop-by-mahasiswa-edit', 'id' => $key]);
                    }else if ($action === 'cancel') {
                        return Url::toRoute(['cancel-by-mahasiswa', 'id' => $key]);
                    }
                    // else if($action === 'download'){

                    //     return Url::toRoute(['download', 'id' => $model->laporan_workshop_id]); 
                    // }
                  }
            ],

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
