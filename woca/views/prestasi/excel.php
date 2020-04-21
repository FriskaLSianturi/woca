<?php
	use backend\modules\woca\models\StatusPeserta;
	\backend\modules\woca\assets\web\php\ExcelGrid::Widget([
		'dataProvider'=> $dataProvider,
		'filterModel' => $searchModel,
		'filename'	  => 'DataPrestasi',
		'properties'  => [

		],
		'columns'	 => [
			['class' =>  'yii\grid\SerialColumn'],
			'nama_kompetisi', 
			'created_by',
			[
                'label' => 'Tingkatan',
                'value' => function($model){
                    $result = null;
                    $statuskompetisi = StatusPeserta::find()->where(['status_prestasi_id' => $model->status_prestasi_id ])->One();
                    $result = $statuskompetisi->status_prestasi_peserta;

                    return $result; 	
                }
            ],
			'tahun',
			'pelaksana',
			 		]
	])
?>