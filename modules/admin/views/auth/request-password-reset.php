<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>",
];

?>

<p class="login-box-msg">Password reset</p>

<?php $form = ActiveForm::begin([
    'id' => 'reset-form',
    'enableClientValidation' => false,
]); ?>

<?= $form
    ->field($model, 'email', $fieldOptions1)
    ->label(false)
    ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

<div class="row">
    <div class="col-xs-4 col-xs-offset-8">
        <?= Html::submitButton('Reset', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
