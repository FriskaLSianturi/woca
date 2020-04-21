<?php

namespace backend\modules\woca\controllers;

use Yii;
use backend\modules\woca\models\Workshop;
use backend\modules\woca\models\LaporanWorkshopFile;
use backend\modules\woca\models\search\WorkshopSearch;
use backend\modules\woca\models\search\StatusKegiatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use mPDF;
/**
 * WorkshopController implements the CRUD actions for Workshop model.
 */
class WorkshopController extends Controller
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
     * Lists all Workshop models.
     * @return mixed
     */
    public function actionIndexMahasiswa()
    {
        $searchModel = new WorkshopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        return $this->render('IndexMahasiswa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'status_kegiatan_id' => $status_workshop,
        ]);
    }
        public function actionIndexAdmin()
    {
        $searchModel = new WorkshopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['deleted' => 0]);
        $status_request = Yii::$app->request->get('status_kegiatan_id');
        if($status_request == 1 || $status_request == 2 || $status_request == 3){
            $params['IzinBermalamSearch']['status_kegiatan_id'] = $status_request;
        }

        return $this->render('IndexAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status_kegiatan_id' =>  $status_request,

        ]);
    }

    /**
     * Displays a single Workshop model.
     * @param integer $id
     * @return mixed
     */
    public function actionWorkshopByMahasiswaView($id)
    {
        return $this->render('WorkshopByMahasiswaView', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWorkshopByAdminView($id)
    {
        return $this->render('WorkshopByAdminView', [
            'model' => $this->findModel($id),
        ]);
    }

  
    /**
     * Creates a new Workshop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWorkshopByMahasiswaAdd()
    {
        $model = new Workshop(); 
         if ($model->load(Yii::$app->request->post())) { 
                $model->files = UploadedFile::getInstances($model, 'files');
                $modelFile = new LaporanWorkshopFile();
                if($model->files != null){ 

                        $laporan = UploadedFile::getInstance($model,'files'); 
                        $laporanname= $laporan->baseName.'.'.$laporan->getExtension();
                       
                        $fileDir = Yii::getAlias('@WorkshopFilePath').'/'.$laporanname;
                        $modelFile->lokasi_file = $fileDir;
                        $modelFile->nama_file = $laporanname; 
                        $model->save(false);                     
                       
                        $modelFile->deleted = 0;

                        if($modelFile->validate()){ 
                            $laporan->saveAs(Yii::getAlias('@WorkshopFilePath').'/'.$laporanname);
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
              $model->laporan_workshop_id = $modelFile->laporan_workshop_id;
              $model->save(false);

              return $this->redirect(['workshop-by-mahasiswa-view', 'id' => $model->workshop_id]);

        } else {
            return $this->render('WorkshopByMahasiswaAdd', [
                'model' => $model,
            ]);
        }
      } 

    /**
     * Updates an existing Workshop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
   public function actionWorkshopByMahasiswaEdit($id)
    {
        $model = $this->findModel($id);

        
        $modelLampiran = LaporanWorkshopFile::find()->where(['laporan_workshop_id' =>$model->laporan_workshop_id])->One();
      //  $modelLampiran->softDelete();
       // var_dump($modelLampiran);
        if ($model->load(Yii::$app->request->post())) {
               $model->files = UploadedFile::getInstances($model, 'files');
                 $modelFile = new LaporanWorkshopFile();
                if($model->files != null){ 

                        $laporan = UploadedFile::getInstance($model,'files'); 
                        $laporanname= $laporan->baseName.'.'.$laporan->getExtension();
                       
                        $fileDir = Yii::getAlias('@WorkshopFilePath').'/'.$laporanname;
                        $modelFile->lokasi_file = $fileDir;
                        $modelFile->nama_file = $laporanname; 
                        $model->save(false);                     
                       
                        $modelFile->deleted = 0;

                        if($modelFile->validate()){ 
                            $laporan->saveAs(Yii::getAlias('@WorkshopFilePath').'/'.$laporanname);
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
              $model->laporan_workshop_id = $modelFile->laporan_workshop_id;
              $model->save(false);
          return $this->redirect(['workshop-by-mahasiswa-view', 'id' => $model->workshop_id]);

        } else {
            return $this->render('WorkshopByMahasiswaEdit', [
                'model' => $model,
                'modelLampiran' => $modelLampiran,       
             //   'files' => $file                                                       ,
            ]);
        }
    }
    /**
     * Deletes an existing Workshop model.
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
     * Finds the Workshop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workshop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workshop::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

       public function actionDownloadAdmin($id){
               //
       $model = new Workshop();
      $fileworkshop = LaporanWorkshopFile::find()->where(['laporan_workshop_id' => $id])->One();
      //var_dump($fileworkshop);
      //print_r($fileworkshop->nama_file);
      $path  = Yii::getAlias('@WorkshopFilePath');
      $data  = $fileworkshop->nama_file;
      $file  = $path.'\\'.$data;

      if(file_exists($file)){
      Yii::$app->response->SendFile($file);
      }else{
          \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['index-admin']);
      }       
    }
        public function actionDownloadMahasiswa($id){
      $model = new Workshop();
      $fileworkshop = LaporanWorkshopFile::find()->where(['laporan_workshop_id' => $id])->One();
      //var_dump($fileworkshop);
      //print_r($fileworkshop->nama_file);
      $path  = Yii::getAlias('@WorkshopFilePath');
      $data  = $fileworkshop->nama_file;
      $file  = $path.'\\'.$data;

      if(file_exists($file)){
      Yii::$app->response->SendFile($file);
      }else{
          \Yii::$app->messenger->addErrorFlash("File Tidak Tersedia");
            return $this->redirect(['index-mahasiswa']);
      }       
    }
 
        public function actionCancelByMahasiswa($id)
    {
         $model = $this->findModel($id);

        if ($model->status_kegiatan_id = 1) {
            $model->status_kegiatan_id = 4;
           
            $model->save();

            \Yii::$app->messenger->addSuccessFlash("Request dibatalkan");
            return $this->redirect(['index-mahasiswa']);
        } else {
            \Yii::$app->messenger->addErrorFlash("Request tidak bisa diubah bila status sudah cancel");
            return $this->render('IndexMahasiswa', [
                'model'=>$model
            ]);
        }
    }
    
    public function actionApproveByAdminIndex($workshop){
        $model = $this->findModel($workshop);

        if($model->status_kegiatan_id == 1){
           $model->status_kegiatan_id = 2;
           $model->save();
          \Yii::$app->messenger->addSuccessFlash("Berhasil Approve");
          return $this->redirect('index-admin');
        }else{
             \Yii::$app->messenger->addSuccessFlash("Tidak Berhasil Approve");
          return $this->render('IndexAdmin');
         
        }


    }
    public function actionRejectByAdminIndex($workshop){
      $model = $this->findModel($workshop);
      if($model->status_kegiatan_id == 1){
          $model->status_kegiatan_id = 3;
          $model->save();
           \Yii::$app->messenger->addSuccessFlash("Workshop berhasil di Reject");
          
          return $this->redirect('index-admin');
      }else{
             \Yii::$app->messenger->addErrorFlash("Tidak Berhasil Approve");
           return $this->render('IndexAdmin');
         
        }
    }
    public function actionExcel()
    {
        $searchModel = new WorkshopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('excel', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     
}


