<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Media */
/* @var $form yii\widgets\ActiveForm */

$model->created_at = date("Y-m-d H:i:s");
?>


<div class="media-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'animated']]); ?>
    
    <?php    
        // Usage with ActiveForm and model
    echo $form->field($model, 'files[]')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
            ],
           'pluginOptions' => [
           'showPreview' => true,
           'showCaption' => true,
           'showRemove' => true,
           'showUpload' => false,
        ]
    ]);
    ?>
    
    <?php // echo $form->field($model, 'created_at')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $model->created_at]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>