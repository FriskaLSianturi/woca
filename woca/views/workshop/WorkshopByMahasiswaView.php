    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\woca\models\LaporanWorkshopFile;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Workshop */

$this->title = $model->judul_workshop;
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index-mahasiswa']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['workshop-by-mahasiswa-edit', 'id' => $model->workshop_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->workshop_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'workshop_id',
            // 'laporan_workshop_id',
            'judul_workshop',
            'tanggal_mulai',
            'tanggal_berakhir',
            'pembicara',
            'status_kegiatan_id',
            'pelaksana',
             ['label' => 'File',
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

            
        ],
    ]) ?>

</div>
