<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_r_status_peserta".
 *
 * @property integer $status_prestasi_id
 * @property string $status_prestasi_peserta
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $creted_by
 * @property string $update_at
 * @property string $update_by
 *
 * @property WocaPrestasi[] $wocaPrestasis
 */
class StatusPeserta extends \yii\db\ActiveRecord
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
        return 'woca_r_status_peserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'update_at'], 'safe'],
            [['status_prestasi_peserta', 'deleted_by', 'creted_by', 'update_by'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_prestasi_id' => 'Status Prestasi ID',
            'status_prestasi_peserta' => 'Status Prestasi Peserta',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'creted_by' => 'Creted By',
            'update_at' => 'Update At',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestasis()
    {
        return $this->hasMany(Prestasi::className(), ['status_prestasi_id' => 'status_prestasi_id']);
    }
}
