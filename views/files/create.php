<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = 'Anexo para solicitação #'.Yii::$app->getRequest()->getQueryParam('id');
?>
<div class="files-create">

    <h2><?= Html::encode($this->title) ?></h2>
    <hr/>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
