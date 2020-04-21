<?php

namespace backend\modules\woca\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\modules\woca\models\Prestasi;
use backend\modules\woca\models\search\PrestasiSearch;
use backend\modules\woca\models\StatusPeserta;
use backend\modules\woca\models\SertifikatFile;

/**
 * PrestasiController implements the CRUD actions for Prestasi model.
 */
class PrestasiController extends Controller
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

    /**
     * Lists all Prestasi models.
     * @return mixed
     */
    public function actionPrestasiByAdminIndex()
    {
        $searchModel = new PrestasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        //$prestasisiswa = new StatusPeserta::find()->where([$model=>'status_prestasi_id'] = 1);
        $dgrafik = Yii::$app->db->createCommand(
            'SELECT tahun, COUNT(tahun) as jlhperthn FROM woca_prestasi WHERE 
                    status_prestasi_id = 1 OR 
                    status_prestasi_id = 2 OR 
                    status_prestasi_id = 3 OR 
                    status_prestasi_id = 4 OR 
                    status_prestasi_id = 5 
                    GROUP BY tahun'
        )->queryAll();

        return $this->render('PrestasiByAdminIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dgrafik' => $dgrafik
        ]);
    }


    public function actionPrestasiByMahasiswaIndex()
    {
        $searchModel = new PrestasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        //$prestasisiswa = new StatusPeserta::find()->where([$model=>'status_prestasi_id'] = 1);
        $dgrafik = Yii::$app->db->createCommand(
            'SELECT tahun, COUNT(tahun) as jlhperthn FROM woca_prestasi WHERE 
                    status_prestasi_id = 1 OR 
                    status_prestasi_id = 2 OR 
                    status_prestasi_id = 3 OR 
                    status_prestasi_id = 4 OR 
                    status_prestasi_id = 5 
                    GROUP BY tahun'
        )->queryAll();

        return $this->render('PrestasiByMahasiswaIndex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dgrafik' => $dgrafik
        ]);
    }

    /**
     * Displays a single Prestasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrestasiByMahasiswaView($id)
    {
        return $this->render('PrestasiByMahasiswaView', [
            'model' => $this->findModel($id),
        ]);
    }
        public function actionPrestasiByAdminView($id)
    {
        return $this->render('PrestasiByAdminView', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prestasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPrestasiByMahasiswaAdd()
    {
       $model = new Prestasi();
       $model_status_peserta = StatusPeserta::find()->where(['deleted'=>0])->all(); 
 
       // return $arrYears2;

        if ($model->load(Yii::$app->request->post())) {
           
            $model->filesertifikat = UploadedFile::getInstance($model,'filesertifikat');
            if($model->filesertifikat != null){
                $modelFile = new SertifikatFile();
                $sertifikat = UploadedFile::getInstance($model,'filesertifikat');
                $namasertifikat = $sertifikat->baseName.'.'.$sertifikat->getExtension();
                $fileDir = Yii::getAlias('@SertifikatPath').'/'.$namasertifikat;
                $modelFile->lokasi_file = $fileDir;
                $modelFile->sertifikat_file = $namasertifikat ;
                $modelFile->deleted =0;

                $model->save();

                    if($modelFile->validate()){
                        $sertifikat->saveAs($fileDir);
                        $modelFile->prestasi_id = $model->prestasi_id;
                        $modelFile->save(false);
                    }else{
                        print_r("File tidak bisa di validasi");
                    }
            }

            $model->save(false);
            return $this->redirect(['prestasi-by-mahasiswa-view', 'id' => $model->prestasi_id]);
        } else {
            return $this->render('PrestasiByMahasiswaAdd', [
                'model' => $model,
                'model_status_peserta' => $model_status_peserta,
                 
            ]);
        }
    }

    /**
     * Updates an existing Prestasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionPrestasiByMahasiswaEdit($id)
    {
        $model = $this->findModel($id);
        $model_status_peserta = StatusPeserta::find()->where(['deleted'=>0])->all();
        $modelLampiran = SertifikatFile::find()->where(['prestasi_id' => $model->prestasi_id])->one();
      //  var_dump($modelLampiran);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['prestasi-by-mahasiswa-view', 'id' => $model->prestasi_id]);
        } else {
            return $this->render('PrestasiByMahasiswaEdit', [
                'model' => $model,
                'model_status_peserta' => $model_status_peserta,
                'modelLampiran' => $modelLampiran,
            ]);
        }
    }

    /**
     * Deletes an existing Prestasi model.
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
     * Finds the Prestasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDownloadAdmin($id){
        //
        $sertifikat = SertifikatFile::find()->where(['prestasi_id' => $id])->One();
        $path =Yii::getAlias('@SertifikatPath');
        $file = $path.'\\'.$sertifikat->sertifikat_file; 
        
        if(file_exists($file)){
            Yii::$app->response->sendFile($file);
        }else{
             \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['prestasi-by-admin-index']);
        }
    }
        public function actionDownloadMahasiswa($id){
        //
        $sertifikat = SertifikatFile::find()->where(['prestasi_id' => $id])->One();
        $path =Yii::getAlias('@SertifikatPath');
        $file = $path.'\\'.$sertifikat->sertifikat_file; 
        
        if(file_exists($file)){
            Yii::$app->response->sendFile($file);
        }else{
             \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['prestasi-by-mahasiswa-index']);
        }
    }
    public function actionExcel()
    {
        $searchModel = new PrestasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('excel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCancelByMahasiswa($id){
        $model = $this->findModel($id);
        if($model->status_kegiatan_id == 1)
        {
            $model->status_kegiatan_id= 4;
            $model->save();

            \Yii::$app->messenger->addSuccessFlash("Berhasil cancel data sertfikat");
            return $this->redirect(['prestasi-by-mahasiswa-index']);
        } else {
            \Yii::$app->messenger->addErrorFlash("Tidak bisa di cancel");
            return $this->render('IndexMahasiswa', [
                'model'=>$model
            ]);
        }
    }
    public function actionApproveByAdminIndex($id){
        $model = $this->findModel($id);

        if($model->status_kegiatan_id == 1){
            $model->status_kegiatan_id = 2;
            $model->save();
            \Yii::$app->messenger->addSuccessFlash("Berhasil Approve");
            return $this->redirect('prestasi-by-admin-index');
        }else{
            \Yii::$app->messenger->addSuccessFlash("Tidak Berhasil Approve");
            return $this->render('PrestasiByAdminIndex');

        }


    }
    public function actionRejectByAdminIndex($id){
        $model = $this->findModel($id);
        if($model->status_kegiatan_id == 1){
            $model->status_kegiatan_id = 3;
            $model->save();
            \Yii::$app->messenger->addSuccessFlash("Workshop berhasil di Reject");

            return $this->redirect('prestasi-by-admin-index');
        }else{
            \Yii::$app->messenger->addErrorFlash("Tidak Berhasil Approve");
            return $this->render('PrestasiByAdminIndex');

        }
    }

    
}

 