<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\search\KompetisiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kompetisi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kompetisi_id') ?>

    <?= $form->field($model, 'nama_kompetisi') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'tingkatan_kompetisi_id') ?>

    <?= $form->field($model, 'proposal_kompetisi_id') ?>

    <?php // echo $form->field($model, 'jumlah_peserta') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
