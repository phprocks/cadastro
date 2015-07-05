<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */

$this->title = 'Alterar Solicitação #'.$model->id;
?>
<div class="solicitation-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php if ($flash = Yii::$app->session->getFlash("edit-erro")): ?>

        <div class="alert alert-danger">
            <p class="text-center"><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
