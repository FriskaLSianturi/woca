<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_laporan_workshop_file".
 *
 * @property integer $laporan_workshop_id
 * @property string $nama_file
 * @property string $lokasi_file
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property WocaWorkshop[] $wocaWorkshops
 */
class LaporanWorkshopFile extends \yii\db\ActiveRecord
{

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
        return 'woca_laporan_workshop_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['nama_file', 'lokasi_file', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 200],
             [['laporan_workshop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workshop::className(), 'targetAttribute' => ['laporan_workshop_id' => 'laporan_workshop_id']],
             
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_workshop_id' => 'Laporan Workshop ID',
            'nama_file' => 'Nama File',
            'lokasi_file' => 'Lokasi File',
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
    public function getWorkshops()
    {
        return $this->hasMany(Workshop::className(), ['laporan_workshop_id' => 'laporan_workshop_id']);
    }
}
