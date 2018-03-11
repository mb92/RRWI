<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Media */
$this->title = 'Add file';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="media-create box">
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>