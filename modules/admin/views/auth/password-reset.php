<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>",
];
?>

<p class="login-box-msg">Enter new password</p>

<?php $form = ActiveForm::begin([
    'id' => 'update-form',
    'enableClientValidation' => false,
]); ?>

<?= $form
    ->field($model, 'password', $fieldOptions1)
    ->label(false)
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

<?= $form
    ->field($model, 'password_repeat', $fieldOptions2)
    ->label(false)
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password_repeat')]) ?>

<div class="row">
    <div class="col-xs-4 col-xs-offset-8">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'update-button']) ?>
    </div>
</div>


<?php ActiveForm::end(); ?>
