<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Solicitation */

$this->title = 'Anexo para solicitação #'.$model->id;
?>
<div class="solicitation-create">

	<h1><?= Html::encode($this->title) ?></h1>
	<hr/>
    
    <?= $this->render('_fileupload', [
        'model' => $model,
    ]) ?>

</div>
