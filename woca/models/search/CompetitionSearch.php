<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\Competition;

/**
 * CompetitionSearch represents the model behind the search form about `backend\modules\woca\models\Competition`.
 */
class CompetitionSearch extends Competition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kompetisi', 'proposal_kompetisi', 'jumlah_peserta', 'deleted'], 'integer'],
            [['nama_kompetisi', 'tgl_kompetisi', 'tingkatan_kompetisi', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'update_at', 'updated_by'], 'safe'],
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
        $query = Competition::find();

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
            'id_kompetisi' => $this->id_kompetisi,
            'tgl_kompetisi' => $this->tgl_kompetisi,
            'proposal_kompetisi' => $this->proposal_kompetisi,
            'jumlah_peserta' => $this->jumlah_peserta,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'nama_kompetisi', $this->nama_kompetisi])
            ->andFilterWhere(['like', 'tingkatan_kompetisi', $this->tingkatan_kompetisi])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
