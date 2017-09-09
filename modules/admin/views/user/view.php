<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view box">

    <div class="box-body">

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php /*echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) */ ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
            'email:email',
            // 'auth_key',
            // 'access_token',
            // 'refresh_token',
            // 'password',
            // 'password_reset_token',
            // 'updated_at',
            'created_at',
            ],
        ]) ?>
        
        <br/>
        <div class="col-sm-12 text-center">
        <?= Html::a('Return to dashboard', [Yii::$app->getHomeUrl()], ['class' => 'btn btn-default']) ?>
        </div>

    </div>
</div>
