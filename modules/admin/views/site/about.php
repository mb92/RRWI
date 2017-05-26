<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Clients, Actions & Files';
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
<tr>
	<td colspan="4" bgcolor="orange"><h2>Clients</h2></td>
</tr>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>created_at</th>
	</tr>
	<?php foreach ($clients as $c): ?>
		<tr>
			<td><?= Html::encode($c->id); ?></td>
			<td><?= Html::encode($c->name); ?></td>
			<td><?= Html::encode($c->email); ?></td>
			<td><?= Html::encode($c->created_at); ?></td>
		</tr>
	<?php endforeach ?>
<tr>
	<td colspan="4" bgcolor="lime"><h2>Actions</h2></td>
</tr>
	<?php foreach ($actions as $a): ?>
		<tr>
			<td><?= Html::encode($a->id); ?></td>
			<td><?= Html::encode($a->action); ?></td>
			<td><?= Html::encode($a->path); ?></td>
			<td><?= Html::encode($a->created_at); ?></td>
		</tr>
	<?php endforeach ?>
</table>
<br/>
<h2>Files</h2>
<table class="table table-bordered">
<?php foreach ($actions as $a): ?>
		<?php if($a->path != '' && $a->action == 'tP') {?>
		<tr>
			<td>
			
			<img src="<?= Url::toRoute(['site/image', 'n' => $a->path]);?>"/>
			</td>
			<td></td>
			<td></td>
		</tr>
		<?php } ?>
	<?php endforeach ?>
</table>

