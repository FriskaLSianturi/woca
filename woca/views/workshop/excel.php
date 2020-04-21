<?php
use backend\modules\woca\models\StatusKegiatan;
\backend\modules\woca\assets\web\php\ExcelGrid::Widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'filename'	  => 'DataWorkshop',
    'properties'  => [

    ],
    'columns'	 => [
        ['class' =>  'yii\grid\SerialColumn'],
        'judul_workshop',
        'pelaksana',
        'pembicara',
        [
            'label' => 'Status kegiatan',
            'value' => function($model){
                $result = null;
                $statusworkshop = StatusKegiatan::find()->where(['status_kegiatan_id' => $model->status_kegiatan_id ])->One();
                $result = $statusworkshop->status_kegiatan;

                return $result;
            }
        ],
        'tanggal_mulai',
        'tanggal_berakhir',
    ]
])
?>