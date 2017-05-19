<?php 
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<h1>
<?= HTML::encode($this->title); ?>
<small>Selfie-app</small>
</h1>
<?= Breadcrumbs::widget([
'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
