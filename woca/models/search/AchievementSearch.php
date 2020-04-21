<?php

namespace backend\modules\woca\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\woca\models\Achievement;

/**
 * AchievementSearch represents the model behind the search form about `backend\modules\woca\models\Achievement`.
 */
class AchievementSearch extends Achievement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sertifikat', 'id_mahasiswa', 'tahun_kegiatan', 'deleted'], 'integer'],
            [['nama_kompetisi', 'status_pesertakegiatan', 'angkatan', 'file_sertifikat', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'update_at', 'updated_by'], 'safe'],
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
        $query = Achievement::find();

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
            'id_sertifikat' => $this->id_sertifikat,
            'id_mahasiswa' => $this->id_mahasiswa,
            'tahun_kegiatan' => $this->tahun_kegiatan,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'nama_kompetisi', $this->nama_kompetisi])
            ->andFilterWhere(['like', 'status_pesertakegiatan', $this->status_pesertakegiatan])
            ->andFilterWhere(['like', 'angkatan', $this->angkatan])
            ->andFilterWhere(['like', 'file_sertifikat', $this->file_sertifikat])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
