<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_workshop".
 *
 * @property integer $workshop_id
 * @property integer $laporan_worksop_id
 * @property string $judul_workshop
 * @property string $tanggal
 * @property string $pelaksana
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property WocaLaporanWorkshopFile $laporanWorksop
 */
class Workshop extends \yii\db\ActiveRecord
{

    public $files;
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
        return 'woca_workshop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul_workshop','tanggal_mulai','tanggal_berakhir','pelaksana','pembicara'],'required'],
            [['laporan_workshop_id', 'deleted'], 'integer'],
            [['tanggal_mulai','tanggal_berakhir', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['files'], 'file'],
            [['files'], 'required', 'on'=>['create']],
            [['tanggal_berakhir'],'isValid'],
            [['judul_workshop', 'pelaksana','pembicara', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32], 
            [['laporan_workshop_id'], 'exist', 'skipOnError' => true, 'targetClass' => LaporanWorkshopFile::className(), 
            'targetAttribute' => ['laporan_workshop_id' => 'laporan_workshop_id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workshop_id' => 'Workshop ID',
            'laporan_workshop_id' => 'Laporan Worksop ID',
            'judul_workshop' => 'Judul Workshop',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_berakhir' => 'Tanggal Berakhir',
            'status_kegiatan_id' => 'Status Workshop Id',
            'pelaksana' => 'Pelaksana',
            'pembicara' => 'pembicara',
            'files' => 'File',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }


        public function isValid($attribute, $params)
    {
        if(strtotime($this->tanggal_mulai)>=strtotime($this->tanggal_berakhir))
            $this->addError($attribute, 'Tidak boleh lebih awal atau sama dengan Tanggal Mulai workshop !');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLaporanWorkshopFile()
    {
        return $this->hasOne(LaporanWorkshopFile::className(), ['laporan_workshop_id' => 'laporan_workshop_id']);
    }

    public function getStatusKegiatan()
    {
        return $this->hasOne(StatusKegiatan::className(), ['status_kegiatan_id' => 'status_kegiatan_id']);
    }
}
