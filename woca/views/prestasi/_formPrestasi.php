<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Prestasi */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="prestasi-form">

     <?php
       $form = ActiveForm::begin([
          'layout' => 'horizontal',
          'options' => ['enctype' => 'multipart/form-data'],
          'fieldConfig' => [
              'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
              'horizontalCssClasses' => [
                 'label' => 'col-sm-2',
                 'wrapper' => 'col-sm-8',
                 'error' => '',
                 'hint' => '',
              ],
           ],
       ]);
    ?>

    <?= $form->field($model, 'nama_kompetisi')->textInput()  ?>
    <?= $form->field($model, 'tahun')->textInput(['type' => 'number'])  ?>
    <?= $form->field($model, 'status_prestasi_id',[
                    'horizontalCssClasses' => ['wrapper' => 'col-sm-5',],
                    ])->dropDownList(ArrayHelper::map($model_status_peserta, 'status_prestasi_id', 'status_prestasi_peserta' ), ["prompt"=>"Status Peserta"])
                ->label("Status Peserta"); 
    ?>


    <?= $form->field($model, 'pelaksana')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'filesertifikat')->fileInput(['required' => true])?>
     <div class="col-md-1 col-md-offset-2"> 
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
