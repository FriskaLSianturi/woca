<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\woca\models\Workshop */

$this->title = 'Tambah Data Workshop';
$this->params['breadcrumbs'][] = ['label' => 'Workshops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
