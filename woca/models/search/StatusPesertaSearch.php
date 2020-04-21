<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\StatusPeserta;

/**
 * StatusPesertaSearch represents the model behind the search form about `backend\modules\woca\models\StatusPeserta`.
 */
class StatusPesertaSearch extends StatusPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_prestasi_id', 'deleted'], 'integer'],
            [['status_prestasi_peserta', 'deleted_at', 'deleted_by', 'created_at', 'creted_by', 'update_at', 'update_by'], 'safe'],
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
        $query = StatusPeserta::find();

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
            'status_prestasi_id' => $this->status_prestasi_id,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'status_prestasi_peserta', $this->status_prestasi_peserta])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'creted_by', $this->creted_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
