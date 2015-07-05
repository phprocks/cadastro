<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = 'Alterar Solicitação #'.$model->id;
?>
<div class="tasks-update">

    <h2><i class="fa fa-newspaper-o"></i> <?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
