<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">
    <div class="box-body">

    
        <p>
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
                <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
            'email:email',
            'auth_key',
            'access_token',
            'refresh_token',
            // 'password',
            // 'password_reset_token',
            // 'updated_at',
            // 'created_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
            </div>
</div>
