<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use branchonline\lightbox\Lightbox;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Media */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-view box">
    <div class="box-body">
        <p>
            <?php //Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary animated fadeIn']) ?>
            <?= Html::a('Usuń plik', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger animated fadeIn',
                'data' => [
                    'confirm' => 'Czy na pewno chcesz usunąć ten plik?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Dodaj koleje pliki', ['create'], ['class' => 'btn btn-success animated fadeIn pull-right']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
//            'name',
            'attributes' =>
                [
                    'label' => "Podgląd",
                    'value' => function ($model) {
                        if ($model->ext != 'jpg' && $model->ext != 'png' &&  $model->ext != 'bmp' ) {
                            return ExtIcons::widget(['ext' => $model->ext, 'imgWidth' => '50']);
                        } else {
                            return Lightbox::widget([
                                
                                'files' => [
                                    [
                                        'thumb' => Yii::$app->params['mediaDir'].'thumb_'.$model->slug,
                                        'original' => Yii::$app->params['mediaDir'].$model->name,
                                        'title' => $model->name,
                                        'thumbOptions' => ['width' => '100px']
                                    ]
                                ]
                            ]);
                            
                            
                            
//                            return Html::img('/'.Yii::$app->params['mediaDir'].$model->name, ['width' => '100', 'height' => 'auto', 'alt' => 'Brak pliku']);
                        }
                            
                    },
                    'format' => 'raw'
                ],
            'slug',
            'ext',
//            'created_at',
            [
                'attribute' => 'created_at',
                'value' => function ($model) { return \Yii::$app->formatter->asDatetime($model->created_at); },
                'format' => 'raw'
            ],
            ],
            'options' => ['class' => 'table table-striped table-bordered detail-view animated fadeInUp'],
        ]) ?>
    </div>
</div>