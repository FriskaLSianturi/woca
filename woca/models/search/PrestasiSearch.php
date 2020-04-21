<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\Prestasi;

/**
 * PrestasiSearch represents the model behind the search form about `backend\modules\woca\models\Prestasi`.
 */
class PrestasiSearch extends Prestasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prestasi_id', 'status_prestasi_id', 'deleted'], 'integer'],
            [['nama_kompetisi', 'tahun', 'pelaksana', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
         //   [['filesertifikat'],'file'],
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
        $query = Prestasi::find();

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
            'prestasi_id' => $this->prestasi_id,
            'status_prestasi_id' => $this->status_prestasi_id,
        //   'filesertifikat' => $this->filesertifikat,
            'tahun' => $this->tahun,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_kompetisi', $this->nama_kompetisi])
            ->andFilterWhere(['like', 'pelaksana', $this->pelaksana])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
       //     ->andFilterWhere(['like', 'filesertifikat', $this->filesertifikat])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
