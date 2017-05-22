<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stores-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= Html::a('Add new Store', ['create'], ['class' => 'btn btn-success']) ?>

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'country.short',
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    ?>

</div>


