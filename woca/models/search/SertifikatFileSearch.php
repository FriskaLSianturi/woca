<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\SertifikatFile;

/**
 * SertifikatFileSearch represents the model behind the search form about `backend\modules\woca\models\SertifikatFile`.
 */
class SertifikatFileSearch extends SertifikatFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sertifikat_file_id', 'prestasi_id', 'deleted'], 'integer'],
            [['sertifikat_file', 'lokasi_file', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'udpdate_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SertifikatFile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sertifikat_file_id' => $this->sertifikat_file_id,
            'prestasi_id' => $this->prestasi_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'sertifikat_file', $this->sertifikat_file])
            ->andFilterWhere(['like', 'lokasi_file', $this->lokasi_file])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'udpdate_by', $this->udpdate_by]);

        return $dataProvider;
    }
}
