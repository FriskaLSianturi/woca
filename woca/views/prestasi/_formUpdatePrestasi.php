<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Prestasi */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .marginkiri{
        margin-left: 25px;
    }
</style>

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
    <?= $form->field($model, 'tahun')->textInput()  ?>
    <?= $form->field($model, 'status_prestasi_id',[
                    'horizontalCssClasses' => ['wrapper' => 'col-sm-5',],
                    ])->dropDownList(ArrayHelper::map($model_status_peserta, 'status_prestasi_id', 'status_prestasi_peserta' ), ["prompt"=>"Status Peserta"])
                ->label("Status Peserta"); 
    ?>


    <?= $form->field($model, 'pelaksana')->textInput(['maxlength' => true]) ?>
    <?php
    $idx = 1;
    echo("<div class='col-sm-12'>");

    echo("<div class='col-sm-1 marginkiri' ></div>
            <div>
            <p class='col-sm-8 marginkiri' >" . Html::a($modelLampiran->sertifikat_file, ['download', 'id' => $modelLampiran->prestasi_id]) . "</p>"  .
        "</div>");

    echo("</div><br>");
    ?>
    <?= $form->field($model, 'filesertifikat')->fileInput()?> 
     <div class="col-md-1 col-md-offset-2"> 
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
