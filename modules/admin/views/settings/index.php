<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index box">
    <div class="box-body">

    
        <p>
            <?php // echo Html::a(Yii::t('app', 'Create Settings'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
                <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
            'param',
            'slug',
            'value',
            'description',

                ['class' => 'yii\grid\ActionColumn',
                 'template' => '{update}',
                ],
            ],
        ]); ?>
            </div>
</div>
