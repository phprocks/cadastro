<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */

$this->title = 'Anexos para solicitação #'.$model->id;
?>
<div class="solicitation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_files', [
        'model' => $model,
    ]) ?>

</div>
