<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\ProposalKompetisiFile;

/**
 * ProposalKompetisiFileSearch represents the model behind the search form about `backend\modules\woca\models\ProposalKompetisiFile`.
 */
class ProposalKompetisiFileSearch extends ProposalKompetisiFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proposal_kompetisi_file_id', 'kompetisi_id', 'deleted'], 'integer'],
            [['file_proposal', 'lokasi_proposal', 'deleted_at', 'deleted_by', 'created_at', 'creared_by', 'update_at', 'update_by'], 'safe'],
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
        $query = ProposalKompetisiFile::find();

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
            'proposal_kompetisi_file_id' => $this->proposal_kompetisi_file_id,
            'kompetisi_id' => $this->kompetisi_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'file_proposal', $this->file_proposal])
            ->andFilterWhere(['like', 'lokasi_proposal', $this->lokasi_proposal])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'creared_by', $this->creared_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
