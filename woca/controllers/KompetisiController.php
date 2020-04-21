<?php

namespace backend\modules\woca\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


use backend\modules\woca\models\search\KompetisiSearch;
use backend\modules\woca\models\Kompetisi;
use backend\modules\woca\models\Dim;
use backend\modules\woca\models\Peserta;
use backend\modules\woca\models\TingkatanKompetisi;
use backend\modules\woca\models\ProposalKompetisiFile;

/**
 * KompetisiController implements the CRUD actions for Kompetisi model.
 */
class KompetisiController extends Controller
{
    public function behaviors()
    {
        return [
            //TODO: crud controller actions are bypassed by default, set the appropriate privilege
            // 'privilege' => [
            //      'class' => \Yii::$app->privilegeControl->getAppPrivilegeControlClass(),
            //      'skipActions' => ['*'],
            //     ],
                
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionPesertas()
    {
        if(null !== Yii::$app->request->post()){
            $pesertas = Dim::find()->where('deleted!=1')->asArray()->all();
            
            return json_encode($pesertas);
        }else{
            return "Ajax failed";
        }
    }
    public function actionTingkatan()
    {
        if(null !== Yii::$app->request->post()){
            $tingkatan = TingkatanKompetisi::find()->where('deleted!=1')->asArray()->all();
            
            return json_encode($tingkatan);
        }else{
            return "Ajax failed";
        }
    }


    /**
     * Lists all Kompetisi models.
     * @return mixed
     */
    public function actionKompetisiByAdminIndex()
    {
        $searchModel = new KompetisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        $pesertas = Dim::find()->where(['deleted' => 0])->asArray()->all();
        $modelData = Kompetisi::find()->where(['deleted'=> 0])->asArray()->all();
//        $query->leftJoin('table_two','main_table.id = table_two.main_id
//    AND (table_two.something=1 OR table_two.something IS NULL)');
        return $this->render('KompetisiByAdminIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pesertas' => $pesertas,
            'modelData' => $modelData,
        ]);
    }

    public function actionKompetisiByMahasiswaIndex()
    {
        $searchModel = new KompetisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        $pesertas = Dim::find()->where(['deleted' => 0])->asArray()->all();
        $modelData = Kompetisi::find()->where(['deleted'=> 0])->asArray()->all();
//        $query->leftJoin('table_two','main_table.id = table_two.main_id
//    AND (table_two.something=1 OR table_two.something IS NULL)');
        return $this->render('KompetisiByMahasiswaIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pesertas' => $pesertas,
            'modelData' => $modelData,
        ]);
    }

    /**
     * Displays a single Kompetisi model.
     * @param integer $id
     * @return mixed
     */
    public function actionKompetisiByMahasiswaView($id)
    {
        return $this->render('KompetisiByMahasiswaView', [
            'model' => $this->findModel($id),
          //  'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
        ]);
    }

    public function actionKompetisiByAdminView($id)
    {
        return $this->render('KompetisiByAdminView', [
            'model' => $this->findModel($id),
            //  'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
        ]);
    }

    /**
     * Creates a new Kompetisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionKompetisiByMahasiswaAdd()
    {
        $ctr=0;
        $model = new Kompetisi();
        $model_tingkatan_kompetisi = TingkatanKompetisi::find()->where(['deleted'=>0])->all();
     //   var_dump($model_tingkatan_kompetisi);
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            
             $model->filekompetisi = UploadedFile::getInstances($model, 'filekompetisi');
                if($model->filekompetisi != null){ 
                        $modelFile = new ProposalKompetisiFile();

                        $proposal = UploadedFile::getInstance($model,'filekompetisi'); 
                        $proposalname= $proposal->baseName.'.'.$proposal->getExtension();
                       
                        $fileDir = Yii::getAlias('@ProposalKompetisiFilePath').'/'.$proposalname;
                        $modelFile->lokasi_proposal = $fileDir;
                        $modelFile->file_proposal = $proposalname; 
                        $model->save(false);                     
                       
                        $modelFile->deleted = 0;

                        if($modelFile->validate()){ 
                            $proposal->saveAs(Yii::getAlias('@ProposalKompetisiFilePath').'/'.$proposalname);
                            $modelFile->kompetisi_id = $model->kompetisi_id;
                            $modelFile->save();
                        }else{
                           print_r("Error here" );

                            $errors = $modelFile->errors;
                            print_r(array_values($errors));
                            die();
                        }
                 
                }else{
                    print_r("null" );
                }

            foreach(Yii::$app->request->post()['peserta'] as $data){
                // echo "<pre>"; print_r($data); die;
                if($data != "empty"){
                    $ctr++;
                    $peserta = new Peserta();
                    $peserta->kompetisi_id = $model->kompetisi_id;
                    $peserta->dim_id = $data;
                    $peserta->save();   
                }
            }
             
              $model->jumlah_peserta =$ctr;
              $model->save(false);
            return $this->redirect(['kompetisi-by-mahasiswa-view', 'id' => $model->kompetisi_id]);
        } else {
            return $this->render('KompetisiByMahasiswaAdd', [
                'model' => $model,
                'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
            ]);
        }
    }

    /**
     * Updates an existing Kompetisi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionKompetisiByMahasiswaEdit($id)
    {
        $model = $this->findModel($id);
        $model_tingkatan_kompetisi = TingkatanKompetisi::find()->where(['deleted'=>0])->all();
        $modelLampiran = ProposalKompetisiFile::find()->where(['kompetisi_id'=>$model->kompetisi_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['kompetisi-by-mahasiswa-view', 'id' => $model->kompetisi_id]);
        } else {
            return $this->render('KompetisiByMahasiswaEdit', [
                'model' => $model,
                'model_tingkatan_kompetisi' => $model_tingkatan_kompetisi,
                'modelLampiran' => $modelLampiran,
            ]);
        }
    }

    /**
     * Deletes an existing Kompetisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kompetisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kompetisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kompetisi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
  
     
    public function actionDownloadAdmin($id){
        $proposal = ProposalKompetisiFile::find()->where(['kompetisi_id' => $id])->One();
        $path = Yii::getAlias('@ProposalKompetisiFilePath');
        $data = $proposal->file_proposal;
        $file = $path.'\\'.$data;

        if(file_exists($file)){
            Yii::$app->response->sendFile($file);
        }else{
        \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['kompetisi-by-admin-index']);        }
    }

    public function actionDownloadMahasiswa($id){
        $proposal = ProposalKompetisiFile::find()->where(['kompetisi_id' => $id])->One();
        $path = Yii::getAlias('@ProposalKompetisiFilePath');
        $data = $proposal->file_proposal;
        $file = $path.'\\'.$data;

        if(file_exists($file)){
            Yii::$app->response->sendFile($file);
        }else{
        \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['kompetisi-by-mahasiswa-index']);        }
    }

     
    public function actionApproveByAdminIndex($id){
        $model = $this->findModel($id);

        if($model->status_kegiatan_id == 1){
            $model->status_kegiatan_id = 2;
            $model->save();
            \Yii::$app->messenger->addSuccessFlash("Berhasil Approve");
            return $this->redirect('kompetisi-by-admin-index');
        }else{
            \Yii::$app->messenger->addSuccessFlash("Tidak Berhasil Approve");
            return $this->render('KompetisiByAdminIndex');

        }


    }
    public function actionRejectByAdminIndex($id){
        $model = $this->findModel($id);
        if($model->status_kegiatan_id == 1){
            $model->status_kegiatan_id = 3;
            $model->save();
            \Yii::$app->messenger->addSuccessFlash("Workshop berhasil di Reject");

            return $this->redirect('kompetisi-by-admin-index');
        }else{
            \Yii::$app->messenger->addErrorFlash("Tidak Berhasil Approve");
            return $this->render('KompetisiByAdminIndex');

        }
    }
    public function actionCancelByMahasiswa($id)
    {
        $model = $this->findModel($id);

        if ($model->status_kegiatan_id = 1) {
            $model->status_kegiatan_id = 4;

            $model->save();

            \Yii::$app->messenger->addSuccessFlash("Request dibatalkan");
            return $this->redirect(['kompetisi-by-mahasiswa-index']);
        } else {
            \Yii::$app->messenger->addErrorFlash("Request tidak bisa diubah bila status sudah cancel");
            return $this->render('KompetisiByMahasiswaIndex', [
                'model'=>$model
            ]);
        }
    }

    public function actionExcel()
    {
        $searchModel = new KompetisiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('excel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
