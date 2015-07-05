<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        O Erro acima ocorreu na tentativa de processar sua solicitação.
    </p>
    <p>
        Caso seja um erro do sistema, entre em contato com o desenvolvedor.
    </p>

</div>
