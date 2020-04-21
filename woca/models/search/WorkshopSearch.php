<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\Workshop;

/**
 * WorkshopSearch represents the model behind the search form about `backend\modules\woca\models\Workshop`.
 */
class WorkshopSearch extends Workshop
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workshop_id', 'laporan_workshop_id', 'deleted'], 'integer'],
            [['judul_workshop', 'tanggal_mulai','tanggal_berakhir', 'pelaksana', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Workshop::find();

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
            'workshop_id' => $this->workshop_id,
            'laporan_workshop_id' => $this->laporan_workshop_id,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'judul_workshop', $this->judul_workshop])
            ->andFilterWhere(['like', 'pelaksana', $this->pelaksana])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
