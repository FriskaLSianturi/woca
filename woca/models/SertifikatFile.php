<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_sertifikat_file".
 *
 * @property integer $sertifikat_file_id
 * @property string $sertifikat_file
 * @property string $lokasi_file
 * @property integer $prestasi_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $udpdate_by
 *
 * @property WocaPrestasi $prestasi
 */
class SertifikatFile extends \yii\db\ActiveRecord
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
        return 'woca_sertifikat_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prestasi_id', 'deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['sertifikat_file', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['lokasi_file'], 'string', 'max' => 200],
            [['prestasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prestasi::className(), 'targetAttribute' => ['prestasi_id' => 'prestasi_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sertifikat_file_id' => 'Sertifikat File ID',
            'sertifikat_file' => 'Sertifikat File',
            'lokasi_file' => 'Lokasi File',
            'prestasi_id' => 'Prestasi ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Udpdate By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestasi()
    {
        return $this->hasOne(Prestasi::className(), ['prestasi_id' => 'prestasi_id']);
    }
}
