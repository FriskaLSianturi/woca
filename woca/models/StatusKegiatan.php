<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_r_status_kegiatan".
 *
 * @property integer $status_kegiatan_id
 * @property string $status_kegiatan
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
class StatusKegiatan extends \yii\db\ActiveRecord
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
        return 'woca_r_status_kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['status_kegiatan', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_kegiatan_id' => 'Status Kegiatan ID',
            'status_kegiatan' => 'Status Kegiatan',
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
        return $this->hasMany(Workshop::className(), ['status_kegiatan_id' => 'status_kegiatan_id']);
    }
    public function getPrestasi()
    {
        return $this->hasMany(Prestasi::className(), ['status_kegiatan_id' => 'status_kegiatan_id']);
    }
    public function getTingkatanKompetisi()
    {
        return $this->hasOne(Kompetisi::className(), ['tingkatan_kompetisi_id' => 'tingkatan_kompetisi_id']);
    }
}
