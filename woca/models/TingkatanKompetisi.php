<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_tingkatan_kompetisi".
 *
 * @property integer $tingkatan_kompetisi_id
 * @property string $tingkatan
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property WocaKompetisi $tingkatanKompetisi
 */
class TingkatanKompetisi extends \yii\db\ActiveRecord
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
        return 'woca_r_tingkatan_kompetisi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['tingkatan', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['tingkatan_kompetisi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kompetisi::className(), 'targetAttribute' => ['tingkatan_kompetisi_id' => 'tingkatan_kompetisi_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tingkatan_kompetisi_id' => 'Tingkatan Kompetisi ID',
            'tingkatan' => 'Tingkatan',
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
    public function getTingkatanKompetisi()
    {
        return $this->hasOne(Kompetisi::className(), ['tingkatan_kompetisi_id' => 'tingkatan_kompetisi_id']);
    }
}
