<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Peserta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peserta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kompetisi_id')->textInput() ?>

    <?= $form->field($model, 'dim_id')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
