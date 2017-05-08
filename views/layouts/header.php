<?php 
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<h1>
Page Header
<small>Optional description</small>
</h1>
<?= Breadcrumbs::widget([
'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>