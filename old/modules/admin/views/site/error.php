<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;


?>
<div class="site-error">

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        <center>
            <a href="<?= Url::home(); ?>" style="height:35px;" class="btn btn-success">
            Go to dashboard
            </a>
        </center>
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
