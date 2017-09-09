<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Settings',
]) . $model->param;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update box">
    <div class="box-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
