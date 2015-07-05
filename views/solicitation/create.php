<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */

$this->title = 'Solicitar Cadastro';
?>
<div class="solicitation-create">

    <h2><?= Html::encode($this->title) ?></h2>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
