<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Workshop */
/* @var $form yii\widgets\ActiveForm */
$datetime = new DateTime();
$datetime->modify('-1 day');
?>


<div class="workshop-form">

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

    <?= $form->field($model, 'judul_workshop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_mulai')->widget(DateTimePicker::className(),
        [
            'options' => ['placeholder' => 'Pilih tanggal mulai'],
            'pluginOptions' => [
                'daysOfWeekDisabled: [0]',
                'autoclose' => 'true',
                'todayHighlight' => true,
              //  'endDate'=>date($datetime->format("Y-m-d")),
            ]
        ]);  ?>
    <?= $form->field($model, 'tanggal_berakhir')->widget(DateTimePicker::className(),
        [
            'options' => ['placeholder' => 'Pilih tanggal berakhir'],
            'pluginOptions' => [
                'daysOfWeekDisabled: [0]',
                'autoclose' => 'true',
                'todayHighlight' => true,
                //'endDate'=>date($datetime->format("Y-m-d")),
            ]
        ]);  ?>

    <?= $form->field($model, 'pelaksana')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pembicara')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'files')->fileInput(['required'=>true]) ?>
    <div class="col-md-1 col-md-offset-2"> 
    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
