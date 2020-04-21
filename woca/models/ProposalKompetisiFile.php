<?php

namespace backend\modules\woca\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "woca_proposal_kompetisi_file".
 *
 * @property integer $proposal_kompetisi_file_id
 * @property string $file_proposal
 * @property string $lokasi_proposal
 * @property integer $kompetisi_id
 * @property integer $deleted
 * @property string $deleted_at
 * @property string $deleted_by
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_byat
 * @property string $updated_byby
 *
 * @property WocaKompetisi $kompetisi
 */
class ProposalKompetisiFile extends \yii\db\ActiveRecord
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
        return 'woca_proposal_kompetisi_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kompetisi_id', 'deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_byat'], 'safe'],
            [['file_proposal', 'deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['lokasi_proposal'], 'string', 'max' => 100],
            [['kompetisi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kompetisi::className(), 'targetAttribute' => ['kompetisi_id' => 'kompetisi_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'proposal_kompetisi_file_id' => 'Proposal Kompetisi File ID',
            'file_proposal' => 'File Proposal',
            'lokasi_proposal' => 'Lokasi Proposal',
            'kompetisi_id' => 'Kompetisi ID',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'created By',
            'updated_at' => 'Update At',
            'updated_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKompetisi()
    {
        return $this->hasOne(Kompetisi::className(), ['kompetisi_id' => 'kompetisi_id']);
    }
}
