<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Url;
use common\components\ToolsColumn;
use backend\modules\woca\models\ProposalKompetisiFile;
use backend\modules\woca\models\Peserta;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DimPenilaian */

$this->title = 'Kompetisi';
$uiHelper=\Yii::$app->uiHelper;

?>
    <style type="text/css">
        .r{
            margin-left: 450px;
        }

        .marginp{
            margin-top: 20px;
            margin-bottom: 20px;

        .margintp{
            margin-bottom: 15px;
            margin-top: 15px;
        }
        table thead tr{

        }
        tr.header
        {
            cursor:pointer;
        }

        tr.header:hover {
            background: rgba(0,0,0,0.03);
        }

        .header .sign:after{
            content:"\f0d9";
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
        }
        .header.expand .sign:after{
            content:"\f0d7";
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
        }

        .detail{
            display: none;
            background-color: rgba(0,0,0,0.03);
        }

        .detail-first{
        }
    </style>

    <div class="kompetisi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="marginp">

        <?= Html::a('Workshop', ['workshop/index-admin'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Kompetisi', ['kompetisi/kompetisi-by-admin-index'], ['class' => 'btn btn-info']) ?> &nbsp &nbsp

        <?= Html::a('Prestasi', ['prestasi/prestasi-by-admin-index'], ['class' => 'btn btn-info']) ?>

        <?= Html::a('Export',['excel'], ['class' => 'btn btn-primary r'])?>
    </p>

    <div class="dim-penilaian-view">

        <?php if(!empty($modelData)){ ?>
            <?= $uiHelper->beginContentRow() ?>
            <?= $uiHelper->beginContentBlock(['id' => 'grid-system3','width' => 12,
                'header' => 'Daftar Kompetisi Mahasiswa',
                'icon' => 'fa fa-bars'
            ]) ?>

            <table class="table">
                <thead>
                <tr>
                    <th style="width:30px;">No</th>
                    <th>Nama kompetisi</th>
                    <th>Tahun</th>
                    <!-- <th>Jumlah peserta</th> -->
                    <th>Penyelenggara</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach($modelData as $key => $value){
                    $result = null;
                    $file = ProposalKompetisiFile::find()->where(['kompetisi_id' => $value['kompetisi_id']])->all();
                    foreach($file as $data){
                        $result .= $data->file_proposal. "<br>";
                    }


                    echo '<tr class="header expand">';
                    //echo '    <td><button data-id="'.$key.'" class="sign"></button></td>';
                    echo '    <td>'.$no++.'</td>';
                    echo '    <td><a href="#"> '.($value['nama_kompetisi']).' </a></td>';
                    echo '    <td>'.($value['tahun']).'</td>';
                   // echo '    <td>'.$value['tahun'].'</td>';
                    echo '    <td>'.$value['penyelenggara'].'</td>';
                    echo '    <td>'.$value['deskripsi'].'</td>';
//                    echo '    <td>'.$result.'</td>';

                ?>
                    <td><span class="error" style="width:10px;"></span></td>
                <?php

                    echo '</tr>';
                    //echo $no==2?'<tr class="detail-first">':'<tr class="detail">';
                    echo '<tr class="detail">';
                    //echo '    <td></td>';
                    echo '    <td></td>';
                    echo '    <td colspan="11">';
                    echo '    <div class="'.$key.'">';
                    echo '<b>Nama Peserta: </b><br /><br />';
                    $pesertaKompetisi= new ArrayDataProvider([
                        'allModels' => Peserta::find()->where(['kompetisi_id' => $value['kompetisi_id']])->all(),
                        'pagination' => false,
                    ]);
                    $proposalKompetisi= new ArrayDataProvider([
                        'allModels' =>  ProposalKompetisiFile::find()->where(['kompetisi_id' => $value['kompetisi_id']])->all(),
                        'pagination' => false,
                    ]);
//                    $dpKebaikan = new ArrayDataProvider([
//                        'allModels' => $value['kebaikan'],
//                        'pagination' => false,
//                    ]);
                    ?>

                    <?= $uiHelper->beginTab([
                        'icon' => 'fa fa-shield',
                        'tabs' => [
                            ['id' => 'tp_'.$value['kompetisi_id'], 'label' => 'Peserta', 'isActive' => true],
                            ['id' => 'tk_'.$value['kompetisi_id'], 'label' => 'Proposal', 'isActive' => false],
                        ]
                    ]) ?>
                    <?= $uiHelper->beginTabContent(['id'=>'tp_'.$value['kompetisi_id'], 'isActive' => true]) ?>
                    <?= GridView::widget([
                        'dataProvider' => $pesertaKompetisi,
                        'filterModel' => null,
                        'layout' => '{items}',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                              //  'attribute'=>'nama',
                                'label' => 'Nama',
                                'format' => 'raw',
                                'value'=>  'dim.nama',
                            ],
                        ]
                    ]); ?>
                    <?= $uiHelper->endTabContent() ?>
                    <?= $uiHelper->beginTabContent(['id' => 'tk_'.$value['kompetisi_id'], 'isActive' => false]) ?>
                    <?= GridView::widget([
                        'dataProvider' => $proposalKompetisi,
                        'filterModel' => null,
                        'rowOptions' => function($model){
                            $data = \backend\modules\woca\models\Kompetisi::find()->where(['kompetisi_id' => $model->kompetisi_id])->one();

                            if($data->status_kegiatan_id == 1){
                                return ['class' => 'info'];
                            } else if($data->status_kegiatan_id == 2){
                                return ['class' => 'success'];
                            } else if($data->status_kegiatan_id == 3){
                                return ['class' => 'danger'];
                            } else {
                                return ['class' => 'warning'];
                            }
                        },
                        'layout' => '{items}',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
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
                            ['class' => 'common\components\ToolsColumn',
                                'template' => '{view} {approve} {reject}',
                                'header' => 'Aksi',

                                'buttons' => [
                                    'view' => function ($url, $model){
                                        $data = \backend\modules\woca\models\Kompetisi::find()->where(['kompetisi_id' => $model->kompetisi_id])->one();
                                        return ToolsColumn::renderCustomButton($url, $data, 'View Detail', 'fa fa-eye');
                                    },
                                    'approve' => function ($url, $model){
                                        $data = \backend\modules\woca\models\Kompetisi::find()->where(['kompetisi_id' => $model->kompetisi_id])->one();
                                        if ($data->status_kegiatan_id == 2 || $data->status_kegiatan_id == 3 || $data->status_kegiatan_id == 4) {
                                            return "";
                                         }else{
                                            return ToolsColumn::renderCustomButton($url, $model, 'Approve', 'fa fa-check');
                                        }
                                    },
                                    'reject' => function ($url, $model){
                                        $data = \backend\modules\woca\models\Kompetisi::find()->where(['kompetisi_id' => $model->kompetisi_id])->one();
                                        if ($data->status_kegiatan_id == 2 || $data->status_kegiatan_id == 3 || $data->status_kegiatan_id == 4) {
                                            return "";
                                        }else{
                                            return ToolsColumn::renderCustomButton($url, $model, 'Reject', 'fa fa-times');
                                        }
                                    },

                                ],
                                'urlCreator' => function ($action, $data, $key, $index){
                                    //     $pegawai = Pegawai::find()->where('deleted != 1')->andWhere(['user_id' => Yii::$app->user->identity->user_id])->one();
                                    if ($action === 'view') {
                                        return Url::toRoute(['kompetisi-by-admin-view', 'id' => $data->kompetisi_id]);
                                    }else if ($action === 'approve') {
                                        return Url::toRoute(['approve-by-admin-index', 'id' => $data->kompetisi_id]);
                                    }else if ($action === 'del') {
                                        return Url::toRoute(['del', 'id' => $key]);
                                    }else if ($action === 'reject') {
                                        return Url::toRoute(['reject-by-admin-index', 'id' => $data->kompetisi_id]);

                                    }
                                }
                            ],


                        ],
                    ]); ?>
                    <?= $uiHelper->endTabContent() ?>
                    <?php
                    echo '</div>';
                    echo '    </td>';
                    echo '</tr>';
                } ?>
                </tbody>
            </table>
            <?=$uiHelper->endContentBlock()?>
            <?=$uiHelper->endContentRow() ?>
        <?php } ?>

        <!-- <?php if(!empty($perilaku_now)){ ?>
    <h1>Nilai Perilaku Tahun Ajaran <?= Html::encode($perilaku_now->ta.'/'.((int)$perilaku_now->ta+1)) ?>, Semester <?= Html::encode($perilaku_now->sem_ta==3?"Pendek":($perilaku_now->sem_ta==2?"Genap":"Gasal")) ?> </h1>
    <?= $uiHelper->renderLine(); ?>
    <?= DetailView::widget([
            'model' => $perilaku_now,
            'attributes' => [
                'akumulasi_skor',
                'nilai_huruf',
                [
                    'label' => 'Bentuk pembinaan',
                    'value' => $perilaku_now->pembinaan,
                ]
            ],
        ]) ?>
    <?php } ?>
    <?php if(!empty($perilaku_history)){ ?>
    <h1>History Nilai Perilaku</h1>
    <?= $uiHelper->renderLine(); ?>
    <table class="tree table">
      <thead>
        <tr>
          <th>Tahun Ajaran</th>
          <th>Semester</th>
          <th>Akumulasi Skor</th>
          <th>Nilai Huruf</th>
        </tr>
      </thead>
      <tbody>
      <?php
            //$insIsExist = false;
            foreach ($perilaku_history as $p) {
                ?>
        <tr>
          <td><?=$p->ta.'/'.((int)$p->ta+1) ?></td>
          <td><?=$p->sem_ta==3?"Pendek":($p->sem_ta==2?"Genap":"Gasal") ?></td>
          <td><?=$p->akumulasi_skor ?></td>
          <td><?=$p->nilai_huruf ?></td>
        </tr>
    <?php } ?>
       </tbody>
    </table>
<?php } ?> -->
    </div>
    </div>

<?php
$this->registerJs("
    $(document).ready(function() {
       $('tr.header').eq(0).toggleClass('expand').nextUntil('tr.header').slideToggle('10');
    });
    $('.header').click(function(){
        $(this).toggleClass('expand').nextUntil('tr.header').slideToggle('10');
    });",
    View::POS_END);
?>