<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Countries;
/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
	<?= $form->field($model, 'countryId')
     	->dropDownList(
            ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name')
            ) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
