<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_kompetisi".
 *
 * @property integer $kompetisi_id
 * @property string $nama_kompetisi
 * @property string $tgl_kompetisi
 * @property integer $tingkatan_kompetisi_id
 * @property integer $jumlah_peserta
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property WocaPeserta[] $wocaPesertas
 * @property WocaProposalKompetisiFile[] $wocaProposalKompetisiFiles
 * @property WocaTingkatanKompetisi $wocaTingkatanKompetisi
 */
class Kompetisi extends \yii\db\ActiveRecord
{

    public $filekompetisi,$tingkatan;

    /**
     * behaviour to add created_at and updatet_at field with current datetime (timestamp)
     * and created_by and updated_by field with current user id (blameable)
     */
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
            'delete' => [
                'class' => DeleteBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'woca_kompetisi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['nama_kompetisi','tingkatan_kompetisi_id','tahun','penyelenggara','deskripsi'],'required'],
            [['filekompetisi'], 'file','skipOnEmpty' => true ],
            [['tingkatan_kompetisi_id', 'jumlah_peserta', 'deleted','tahun'], 'integer'],
            [['nama_kompetisi'], 'string', 'max' => 100],
            [['deskripsi'], 'string', 'max' => 300],
            [['deleted_by', 'created_by', 'updated_by','tingkatan','penyelenggara'], 'string', 'max' => 32],
            [['status_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusKegiatan::className(), 'targetAttribute' => ['status_kegiatan_id' => 'status_kegiatan_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kompetisi_id' => 'Kompetisi ID',
            'nama_kompetisi' => 'Nama Kompetisi',
            'tahun' => 'Tahun',
            'tingkatan_kompetisi_id' => 'Tingkatan Kompetisi',
            'status_kegitan_id' => 'Status Kegiatan',
            'filekompetisi' => "Proposal Kompetisi",
            'tingkatan' =>'Tingkatan Kompetisi',
            'jumlah_peserta' => 'Jumlah Peserta',
            'penyelenggara' => 'Penyelenggara',
            'deskripsi' => 'Deskripsi',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    // public function valid($attribute, $params)
    // {
    //     if((strtotime($this->tgl_kompetisi) > strtotime(date('Y-m-d'))&& trim($this->tgl_kompetisi)!='') )
    //         $this->addError($attribute, 'Tanggal Kompetisi Tidak Valid !');
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesertas()
    {
        return $this->hasMany(Peserta::className(), ['kompetisi_id' => 'kompetisi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProposalKompetisiFiles()
    {
        return $this->hasMany(ProposalKompetisiFile::className(), ['kompetisi_id' => 'kompetisi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTingkatanKompetisi()
    {
        return $this->hasOne(TingkatanKompetisi::className(), ['tingkatan_kompetisi_id' => 'tingkatan_kompetisi_id']);
    }
    public function getStatusKegiatan()
    {
        return $this->hasOne(StatusKegiatan::className(), ['status_kegiatan_id' => 'status_kegiatan_id']);
    }
}
