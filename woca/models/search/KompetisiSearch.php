<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\Kompetisi;
use backend\modules\woca\models\ProposalKompetisiFile;

/**
 * KompetisiSearch represents the model behind the search form about `backend\modules\woca\models\Kompetisi`.
 */
class KompetisiSearch extends Kompetisi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kompetisi_id', 'tingkatan_kompetisi_id', 'jumlah_peserta', 'deleted'], 'integer'],
            [['nama_kompetisi', 'tahun', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Kompetisi::find();

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
            'kompetisi_id' => $this->kompetisi_id,
            'tahun' => $this->tahun,
            'tingkatan_kompetisi_id' => $this->tingkatan_kompetisi_id,
            'jumlah_peserta' => $this->jumlah_peserta,
            'penyelenggara' => $this->penyelenggara,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_kompetisi', $this->nama_kompetisi])
            // ->andFilterWhere(['like', 'proposal_kompetisi_file_id', $this->proposal_kompetisi_file_id])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
