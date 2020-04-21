<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_prestasi".
 *
 * @property integer $prestasi_id
 * @property integer $status_prestasi_id
 * @property string $nama_kompetisi
 * @property string $tahun
 * @property string $pelaksana
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property WocaRStatusPeserta $statusPrestasi
 * @property WocaSertifikatFile[] $wocaSertifikatFiles
 */
class Prestasi extends \yii\db\ActiveRecord
{

    public $filesertifikat;
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
        return 'woca_prestasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'integer'],
        //    [['tahun'], 'berangkatValid'],
            [['tahun','nama_kompetisi','pelaksana','status_prestasi_id'],'required'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['filesertifikat'],'file', 'skipOnEmpty' => true],
            [['nama_kompetisi', 'pelaksana', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['status_prestasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPeserta::className(), 'targetAttribute' => ['status_prestasi_id' => 'status_prestasi_id']],
            [['status_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusKegiatan::className(), 'targetAttribute' => ['status_kegiatan_id' => 'status_kegiatan_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prestasi_id' => 'Prestasi ID',
            'status_prestasi_id' => 'Status Prestasi',
            'nama_kompetisi' => 'Nama Kompetisi',
            'tahun' => 'Tahun',
            'pelaksana' => 'Pelaksana',
            'filesertifikat' => 'Sertifikat Prestasi',
            'status_kegiatan_id' => 'Status Kegiatan',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPrestasi()
    {
        return $this->hasOne(StatusPeserta::className(), ['status_prestasi_id' => 'status_prestasi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSertifikatFiles()
    {
        return $this->hasMany(SertifikatFile::className(), ['prestasi_id' => 'prestasi_id']);
    }
    public function getStatusKegiatan()
    {
        return $this->hasOne(StatusKegiatan::className(), ['status_kegiatan_id' => 'status_kegiatan_id']);
    }

}
