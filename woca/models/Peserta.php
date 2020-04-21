<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_peserta".
 *
 * @property integer $peserta_id
 * @property integer $kompetisi_id
 * @property integer $dim_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $update_at
 * @property string $update_by
 *
 * @property DimxDim $dim
 * @property WocaKompetisi $kompetisi
 */
class Peserta extends \yii\db\ActiveRecord
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
        return 'woca_peserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kompetisi_id', 'dim_id', 'deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['dim_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dim::className(), 'targetAttribute' => ['dim_id' => 'dim_id']],
            [['kompetisi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kompetisi::className(), 'targetAttribute' => ['kompetisi_id' => 'kompetisi_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peserta_id' => 'Peserta ID',
            'kompetisi_id' => 'Kompetisi ID',
            'dim_id' => 'Dim ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Update At',
            'updated_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDim()
    {
        return $this->hasOne(Dim::className(), ['dim_id' => 'dim_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKompetisi()
    {
        return $this->hasOne(Kompetisi::className(), ['kompetisi_id' => 'kompetisi_id']);
    }
}
