<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Kompetisi */
/* @var $form yii\widgets\ActiveForm */

$datetime = new DateTime();
$datetime->modify('-1 day');
?>
<style>
    .bawah{
        margin-bottom: 20px;
    }
    .marginkiri{
        margin-left: 25px;
    }
</style>
<div class="kompetisi-form">

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

    <?= $form->field($model, 'nama_kompetisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput(['type' => 'number']) ?>
 
    <?= $form->field($model, 'tingkatan_kompetisi_id',[
                    'horizontalCssClasses' => ['wrapper' => 'col-sm-5',],
                    ])->dropDownList(ArrayHelper::map($model_tingkatan_kompetisi, 'tingkatan_kompetisi_id', 'tingkatan' ), ["prompt"=>"Tingkatan Kompetisi"])
                ->label("Tingkatan"); 
    ?>
 
    <?= $form->field($model, 'penyelenggara')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textArea() ?>
    <?php
    $idx = 1;
    echo("<div class='col-sm-12'>");

    echo("<div class='col-sm-1 marginkiri' ></div>
            <div>
            <p class='col-sm-8 marginkiri' >" . Html::a($modelLampiran->file_proposal, ['download', 'id' => $modelLampiran->kompetisi_id]) . "</p>"  .
        "</div>");

    echo("</div><br>");
    ?>
    <?= $form->field($model, 'filekompetisi')->fileInput(['required' => false]) ?>
       

    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <div class="jumbotron" style="padding:5px">
          <div class="container">
            <h2><center>Daftar Peserta</center></h2>
            <div id="peserta_input">
              <div class="row">
                <div class="col-md-5 col-sm-5">
                  <label>Pilih Peserta</label>
                  <select id="kompetisi-peserta" class="form-control" name="peserta[]"></select>
                </div>
              </div>
            </div>
            <a href="#peserta_input" onclick="addMore()"><br>Tambah Peserta</a><br>
          </div>
        </div>
      </div>
    </div>
 
    <div class="row">
        <div class="col-md-1 col-md-offset-2">
            <div class="form-group bawah">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success bawah' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
        /**
         * Ajax for peserta DynamicForm
         */
        $this->registerJs(
            " 
            $(document).ready(function(){
                showPeserta();

              });


            function showPeserta(){
              
                $.ajax({
                    url: '".\Yii::$app->urlManager->createUrl(['woca/kompetisi/pesertas'])."',
                    type: 'POST',
                    success: function(data){
                        data = jQuery.parseJSON(data);
                        pesertas = '';
                        for(var i = 0; i < data.length; i++){
                          if(i == 0){
                              pesertas += '<option value=\"empty\">Pilih Peserta</option>';
                              pesertas += '<option selected=\"selected\" value=\"'+data[i]['dim_id']+'\">'+data[i]['nama']+'</option>';
                          }else{
                              pesertas += '<option value=\"'+data[i]['dim_id']+'\">'+data[i]['nama']+'</option>';
                          }
                        }
                        $('#kompetisi-peserta').append(pesertas);
                    }
                });
            }
           function addMore(){
                $.ajax({
                    url: '".\Yii::$app->urlManager->createUrl(['woca/kompetisi/pesertas'])."',
                    type: 'POST',
                    success: function(data){
                        data = jQuery.parseJSON(data);
                        pesertas = '';
                        for(var i = 0; i < data.length; i++){
                          if(i == 0){
                              pesertas += '<option selected=\"selected\" value=\"empty\">Nama Peserta</option>';
                              pesertas += '<option value=\"'+data[i]['dim_id']+'\">'+data[i]['nama']+'</option>';
                          }else{
                              pesertas += '<option value=\"'+data[i]['dim_id']+'\">'+data[i]['nama']+'</option>';
                          }
                            
                        }
                        addPeserta(pesertas);
                    }
                });
            }

            function addPeserta(pesertas){

               $('#peserta_input').append('<br></div><div class=row><div class=col-md-5 col-sm-5><div><select id=\"kompetisi-peserta\" class=\"form-control\" name=\"peserta[]\">'+pesertas+'</select></div></div><div class=help-block></div></div>');
           }

        ",
        $this::POS_END);
    ?>
