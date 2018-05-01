<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\widgets\exticons\ExtIcons;
use branchonline\lightbox\Lightbox;
use app\modules\admin\models\Files;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="media-index box">
    <div class="box-body">
        <p>
            <?= Html::a('Add file', ['create'], ['class' => 'btn btn-success animated fadeIn']) ?>
        </p>
        <?= GridView::widget([
            'options' => ['class' => 'animated', 'id' => 'table-files'],
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                                     
                'slug',
                [
                    'attribute' => 'ext',
                    'format' => 'raw',
                    'label' => 'Rozszerzenie',
                    'value' => function($model) {
                        return $model->ext;
                    },
                ],
//            'created_at',
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) { 
                        return \Yii::$app->formatter->asDatetime($model->created_at);
                    },
                    'format' => 'raw'
                ],
                            
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                ],
            ],
        ]); ?>
    </div>
</div>

<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/dist/js/files.js"></script>
