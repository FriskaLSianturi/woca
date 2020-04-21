<?php
use backend\modules\woca\models\TingkatanKompetisi;
use backend\modules\woca\models\Peserta;
\backend\modules\woca\assets\web\php\ExcelGrid::Widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'filename'	  => 'DataKompetisi',
    'properties'  => [

    ],
    'columns'	 => [
        ['class' =>  'yii\grid\SerialColumn'],
        'nama_kompetisi',
        'tahun',
        [
            'label' => 'Tingkatan',
            'value' => function($model){
                $result = null;
                $tingkatankompetisi = TingkatanKompetisi::find()->where(['tingkatan_kompetisi_id' => $model->tingkatan_kompetisi_id])->all();
                foreach ($tingkatankompetisi as $data){
                    $result .= $data->tingkatan;
                }

                return $result;
            }
        ],
        [
            //  'attribute'=>'nama',
            'label' => 'Daftar Peserta',
            'format' => 'raw',
            'value'=>  function($model){
                $result = null;
                $peserta = Peserta::find()->where(['kompetisi_id' => $model->kompetisi_id])->all();
                foreach ($peserta as $data){
                    $result .= $data->dim->nama."/";
                }
                return $result;
            },
        ],
        'jumlah_peserta',
        'penyelenggara',
        'deskripsi',
    ]
])
?>